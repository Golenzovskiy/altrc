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
            arr.push(this.value);
        });
        if (arr[0] == '') {
            arr.shift();
        }
        var request = arr.join('+');
        $('#request').removeClass('hidden').html('<a href="/">Сбросить фильтр:</a> ' + request);

        this.init();
        var button = this.$form.find('#filter').get(0);
        var l = Ladda.create(button);
        l.start();
        /*console.log(this.$form.serialize());*/
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
            var $parent = $(this).parents('.table');

            $parent.find('.current').removeClass('current');

            var $newItem = $('.pattern').clone(true);
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

        $('.js-references').each(function () {
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
        });

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

    var sampleTags = ['пищёвка', 'стройка', 'абвгд', 'еёжз'];
    $('#FieldTags').tagit({
        availableTags: sampleTags
    });

    $('[data-toggle="tooltip"]').tooltip();

    $(document).on("click", ".tag", function () {
        var selectedTag = $(this).data("tag");
        $("#filterResult").find("tr[data-tags]").each(function () {
            if ($.inArray(selectedTag, $(this).data('tags')) == -1) {
                $(this).addClass('hidden').next().addClass('hidden');
            }
        });
        $("#tags-button").find("span").removeClass("label-primary").addClass("label-default");
        $(this).children("span").removeClass("label-default").addClass("label-primary");
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
        /*clipboard.on('success', function(e) {
            console.log(e);
        });

        clipboard.on('error', function(e) {
            console.log(e);
        });*/
    });

    new Clipboard('.clip', {
        target: function (trigger) {
            return $(trigger).parent().get(0);
        }
    });

    $('.js-references-edit').on('click', function (e) {
        e.stopPropagation();
        var $text = $(this).parent().next();
        $text.editable('enable').editable('toggle')
            .on('hidden', function (e, reason) {
                $(this).editable('disable');
            })
            .on('save', function (e, params) {
                var target = $(e.target);
                var position = target.data('position');
                $('input[data-position=' + position + ']').val(params.newValue);
            });
    });

    $('.js-references-create').on('click', function (e) {
        e.stopPropagation();

        var pos = $('[data-position]').last().data('position');
        var $parent = $(this).parents('.table');

        $parent.find('.current').removeClass('current');
        var $newItem = $('.pattern').clone(true);

        $(this).closest('.action').before('<tr class="current">' + $newItem.html() + '</tr>');
        var $value = $parent.find('.current').find('.js-references-change').find('div');

        $('[data-position]').last().attr('name', 'references[]');
        $('[data-position]').last().attr('data-position', pos + 1);

        $('.js-references-change').last().attr('data-position', pos + 1);

        $value.editable('show')
            .on('save', function (e, params) {
                var target = $(e.target);
                var position = target.parent().data('position');
                $('input[data-position=' + position + ']').val(params.newValue);
            });
    });

    $('.js-references-remove').on('click', function (e) {
        var $value = $(this).parent().next();
        console.log($value);
        if ($value.hasClass('js-references-change')) {
            //TODO ajax loader start
            var name = $value.text();
            $value.closest('tr').remove();
        }
    })

});