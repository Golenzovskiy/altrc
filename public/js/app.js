/**
 * Description
 *
 * @author Sintsov Roman <sintsov.roman@gmail.com>
 * @author Stanislav Golenzovskiy <golenzovskiy@gmail.com>
 * @copyright Copyright (c) 2016, Altrc
 */

$.fn.editable.defaults.mode = 'inline';
$.ajaxSetup({
    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
});

function Ajax(form) {
    this.$form = form;
    this.type = {};
    this.url = {};

    this.init = function () {
        this.type = this.$form.attr('method');
        this.url = this.$form.attr('action');
    };

    this.request = function (fn) {
        var request = this.$form.serializeArray();
        var arr = [];

        $(request).each(function (index) {
            // убираем из фильтра поле из облака тегов
            if (this.name != 'filterTags') {
                arr.push(this.value);
            }
        });
        if (arr[0] == '') {
            arr.shift();
        }
        var request = arr.join('+');
        $('#request').removeClass('hidden').html('<a href="/reset">Сбросить фильтр:</a> ' + request);

        this.init();
        var button = this.$form.find('#filter').get(0);
        var l = Ladda.create(button);
        l.start();
        $.ajax({
            url: this.url,
            type: this.type,
            dataType: "json",
            data: this.$form.serialize()
        })
            .done(function (response) {
                fn(response);
            })
            .fail(function () {
                alert("error");
            })
            .always(function () {
                l.stop();
            });
    }
}

var Filter = {
    filter: $('#js-filter'),

    observer: function () {
        var self = this;

        this.filter.on('submit', function (e) {
            e.preventDefault();
            var ajax = new Ajax($(this));
            ajax.request(function (json) {
                if (json.status == 'success') {
                    self.afterResponse(json);
                }
            });
        });

        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            //TODO: ajax loader start
            $.ajax({
                url: url,
                type: 'post',
                dataType: "json",
                data: self.filter.serialize()
            })
                .done(function (json) {
                    if (json.status == 'success') {
                        self.afterResponse(json);
                    }
                })
                .fail(function () {
                    alert("error");
                })
                .always(function () {
                    //TODO: ajax loader stop
                });
        });

        // запуск авто фильтра
        var autoFilter =  this.filter.find('.js-auto-filter');
        if (autoFilter.length) {
            this.filter.trigger('submit');
        }
    },

    afterResponse: function (json) {
        $('#searchResult').html(json.result).removeClass('hidden');
        $('#amount').html(json.amount);
        $('.dropdown-toggle').dropdown();
        $('.js-references-change').each(function () {
            var name = $(this).text();
            var pk = $(this).data('id');

            $(this).editable({
                type: 'text',
                url: '/references/update',
                name: name,
                pk: pk
            });
        });

        /*$('.js-references').each(function () {
            dragula([this, document.getElementById('js-reference-panel')], {
                copy: true,
                removeOnSpill: true
            }).on('drop', function (el) {
                $('#amountReferences').html($('#js-reference-panel').children().length);
                $.ajax({
                    url: '/user/references/store',
                    type: 'post',
                    dataType: "html",
                    data: {'name': $(el).text()}
                })
                    .done(function (response) {
                    })
                    .fail(function () {
                        alert("error");
                    });
            });
        });*/

        new Clipboard('.clip', {
            target: function (trigger) {
                return $(trigger).parent().get(0);
            }
        });
    },

    init: function () {
        if (this.filter.length > 0) {
            this.observer();
        }
    }

};

var References = {
    panel: $('#js-reference-panel'),
    amount: $('#amountReferences'),

    observer: function () {
        var self = this;

        // добавление/удаление референций из списка отобранных
        $(document).on('click', '.favorite-refer', function () {
            var request = '';

            var $el = $(this).parent().find('.references-text');

            if ($(this).hasClass('btn-default')) {
                request = '/user/references/store';
                self.addToPanel($el.clone());
            } else {
                request = '/user/references/remove';
                self.removeFromPanel($el);
            }

            $(this).toggleClass('btn-default btn-primary');

            $.ajax({
                url: request,
                type: 'post',
                dataType: "html",
                data: {'name': $el.text()}
            }).done(function (response) {
            }).fail(function () {
                 alert("error");
            });
        });

        // удаление из панели отобранных референций
        dragula([document.getElementById('js-reference-panel')], {
            removeOnSpill: true
        }).on('remove', function (el) {
            $('#amountReferences').html($('#js-reference-panel').children().length);
            $.ajax({
                url: '/user/references/remove',
                type: 'post',
                dataType: "html",
                data: {'name': $(el).text()}
            })
                .done(function (response) {
                })
                .fail(function () {
                    alert("error");
                });
        });

        $(document).on('click', '.js-references-edit', function (e) {
            e.stopPropagation();
            var $text = $(this).parent().next();
            $text.editable('enable').editable('toggle')
                .on('hidden', function (e, reason) {
                    $(this).editable('disable');
                });

        });

        $(document).on('click', '.js-references-create', function (e) {
            e.stopPropagation();
            var $parent = $(this).closest('.table');

            $parent.find('.current').removeClass('current');

            var $newItem = $parent.find('.pattern').clone(true);
            $(this).closest('.action').before('<tr class="current">' + $newItem.html() + '</tr>');

            var $value = $parent.find('.current').find('.js-references-change').find('div');
            var name = $value.text();
            var pk = $parent.find('.current').find('.js-references-change').data('id');

            $value.editable({
                type: 'text',
                url: '/references/update',
                name: name,
                pk: pk
            }).editable('show');
            //$parent.find('.current span').editable('enable').editable('activate');
        });

        $(document).on('click', '.js-references-remove', function (e) {
            var $value = $(this).parent().next();
            if ($value.hasClass('js-references-change')) {
                //TODO ajax loader start
                var name = $value.text();
                var id = $value.data('id');
                if (id && name) {
                    $.ajax({
                        url: '/references/delete',
                        type: 'post',
                        dataType: "html",
                        data: {'id': id, 'name': name}
                    })
                        .done(function (response) {
                            $value.closest('tr').remove();
                        })
                        .fail(function () {
                            alert("error");
                        })
                        .always(function () {
                            //TODO ajax loader stop
                        });
                }
            }
        });

        $(document).on('click', '.glyphicon-pushpin', function (e) {
            e.preventDefault();

            $(this).parent().toggleClass('btn-default btn-primary');
            var project = $(this).closest('.btn-toolbar').next().find('.js-references:not(:first)');

            if ($(this).parent().hasClass('btn-primary')) {
                if (project.data('description')) {
                    project.each(function (index, value) {
                        $(value).children().html($(this).text() + ' <span class="js-additional-text">(' + project.data('description') + ')</span>');
                    });
                } else {
                    project.each(function (index, value) {
                        $(value).children().html($(this).text() + ' <span class="js-additional-text">(' + project.data('company') + ')</span>');
                    });
                }
            } else {
                $(project).find('.js-additional-text').html('');
            }
        });
    },

    addToPanel: function ($el) {
        this.panel.append($el);
        this.counterUpdate(1);
    },

    removeFromPanel: function ($el) {
        var findText = $el.text();
        this.panel.find('.references-text').each(function () {
            if ($(this).text() == findText) {
                $(this).remove();
            }
        });
        this.counterUpdate(-1);
    },

    counterUpdate: function (value) {
        var total = this.amount.text();
        total = parseInt(total) + parseInt(value);
        this.amount.text(total);
    },

    init: function () {
        this.observer();
    }
};

function checkFields(form) {
    var checks_radios = form.find(':checkbox, :radio'),
        inputs = form.find(':input').not(checks_radios).not('[type="submit"],[type="button"],[type="reset"]');

    var checked = checks_radios.filter(':checked');
    var filled = inputs.filter(function () {
        return $.trim($(this).val()).length > 0;
    });

    if (checked.length + filled.length === 0) {
        return false;
    }

    return true;
}

$(document).ready(function () {
    Filter.init();
    References.init();

    var $form = $('#js-filter');
    var $tagsInput = $("#FieldTags");

    $("#from").datepicker({
        dateFormat: "yy",
        defaultDate: -365,
        changeYear: true,
        yearRange: "1990:+0",
        numberOfMonths: 1,
        onClose: function (selectedDate) {
            //$("#to").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#to").datepicker({
        dateFormat: "yy",
        changeYear: true,
        yearRange: "1990:+0",
        numberOfMonths: 1,
        onClose: function (selectedDate) {
            //$("#from").datepicker("option", "maxDate", selectedDate);
        }
    });

    /* */

    $("form").change(function () {
        $(this).find("button").removeAttr("disabled");
    });

    /* */
    $.ajax({
        url: "/tags",
        dataType: "json",
        success: function(data) {
            var tags = data.length === 1 && data[0].length === 0 ? [] : data;
            $tagsInput.tagit({
                availableTags: tags
            });
        }
    });

    $('[data-toggle="tooltip"]').tooltip();

    $(document).on("click", ".tag", function () {
        var selectedTag = $(this).data("tag");
        $("#tags-button").find("span").removeClass("label-primary").addClass("label-default");
        $(this).children("span").removeClass("label-default").addClass("label-primary");
        var $filterTags = $form.find('#filter-tags');

        /*var currentValue = $filterTags.val();
        $filterTags.val((currentValue) ? $filterTags.val() + ',' + selectedTag : selectedTag);*/

        $filterTags.val((selectedTag != $filterTags.val()) ? selectedTag : '');
        $form.trigger('submit');
    });

    $("#delete").click(function () {
        var pathname = location.pathname.split('/');
        var id = pathname[pathname.length - 1]
        swal({
                title: "Удалить проект?",
                text: "Вы уверены, что хотите полностью удалить проект?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Да, удалить проект!",
                closeOnConfirm: false
            },
            function (isConfirm) {
                if (!isConfirm) return;
                $.ajax({
                    url: "/remove/" + id,
                    dataType: "html",
                })
                    .done(function (data) {
                        swal({
                            title: "Удалено!",
                            text: "Проект удалён.",
                            type: "success"
                        }, function () {
                            window.location.href = "/";
                        });
                    })
                    .error(function (data) {
                        swal("Ошибка!", "Проект не удалён.", "error");
                    });
            })
    });

    $(".handleClose").click(function () {
        $("#menu-bar").slideReveal("hide");
    });

    var slider = $("#menu-bar").slideReveal({
        width: '33%',
        push: false,
        position: "right",
        // speed: 600,
        trigger: $(".handle"),
        // autoEscape: false,
        shown: function (obj) {
            obj.find(".handle").html('<span class="fa fa-chevron-left fa-lg"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>&nbsp;Отобранные!</span>');
            obj.addClass("left-shadow-overlay");
        },
        hidden: function (obj) {
            obj.find(".handle").html('<span class="fa fa-chevron-left fa-lg"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>&nbsp;Отобранные</span>');
            obj.removeClass("left-shadow-overlay");
        }
    });

    $('#logo').change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#logo-image').removeClass('hidden').attr('src', e.target.result);
            };

            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#copy').click(function () {
        var references = $('#js-reference-panel').children();
        var arr = [];
        references.each(function (index, value) {
            arr.push($(value).text().trim());
        });
        var request = arr.join('\n');
        var clipboard = new Clipboard('#copy', {
            text: function() {
                return request;
            }
        });
    });

    new Clipboard('.clip', {
        target: function (trigger) {
            return $(trigger).parent().get(0);
        }
    });

    $('[multiple]').each(function (index, values) {
		var selectedBlock = $(this).next().children().next();
        if ($(values).val()) {
            selectedBlock.html($(values).val().join(', '));
        }
        $(this).change(function () {
            if ($(values).val()) {
                $(this).each(function (index, values) {
                    selectedBlock.html($(values).val().join(', '));
                });
            } else {
                selectedBlock.html('<em>Ничего не выбрано</em>');
            }
        })
    });


    $('.glyphicon-trash').on('click', function(e){
		e.preventDefault();
		$(this).parent().next().html('<em>Ничего не выбрано</em>');
        var select = $(this).parent().parent().prev();
        $(select).children().each(function () {
            $(this).removeAttr("selected");
        });
    });

    $(document).on('click', '.js-dictionary-remove', function (e) {
        var value = $(this).parent().next().text();
        var name = $.trim(value);
        var model = $(this).closest('div .tab-pane').attr('id');
        var tr = (this).closest('tr');
        $.ajax({
            url: '/dictionarys/delete',
            type: 'post',
            dataType: 'html',
            data: {'name': name, 'model': model}
        })
            .done(function () {
                $(tr).closest('tr').remove();
            })
            .fail(function (response) {
                console.log(response.responseText);
            })
            .always(function () {
                //TODO ajax loader stop
            });
    });

    $(document).on('click', '.js-dictionary-edit', function (e) {
        e.stopPropagation();
        var value = $(this).parent().next().text();
        var name = $.trim(value);
        var model = $(this).closest('div .tab-pane').attr('id');
        var value = name;
        $($(this).parent().next()).editable({
			params: function(params) {
				params.model = model;
				return params;
			},
            type: 'text',
            name: name,
            value: value,
            url: '/dictionarys/update',
            pk: 1
        }).editable('toggle');
    });

    $(document).on('click', '.js-dictionary-create', function (e) {
        e.preventDefault();
        var newRow = $(this).closest('tr').next();
        newRow.clone().removeClass('hidden').insertAfter($(this).closest('tr'));
    });

    if (document.location.hash == '#country') {
        $('#myTabs a[href="#country"]').tab('show')
    }
    else if (document.location.hash == '#sectors') {
        $('#myTabs a[href="#sectors"]').tab('show')
    }
    else if (document.location.hash == '#country') {
        $('#myTabs a[href="#country"]').tab('show')
    }

    $('[role = tab]').click(function(){
        var id = $(this).attr('data');
        window.location.hash = $(this).attr('href');
    });

});