/**
 * Description
 *
 * @author Sintsov Roman <sintsov.roman@gmail.com>
 * @author Stanislav Golenzovskiy <golenzovskiy@gmail.com>
 * @copyright Copyright (c) 2016, Altrc
 */
function Ajax(form) {
    this.$form = form;
    this.type = {};
    this.url = {};

    this.init = function () {
        this.type = this.$form.attr('method');
        this.url  = this.$form.attr('action');
    };

    this.request = function (fn) {
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
        .done(function(response) {
            fn(response);
        })
        .fail(function() {
            alert("error");
        })
        .always(function () {
            l.stop();
        });
    }
}

var Filter = {
    filter: $('#js-filter'),

    observer: function() {
        this.filter.on('submit', function (e) {
            e.preventDefault();
            var ajax = new Ajax($(this));
            ajax.request(function(json) {
                if (json.status == 'success') {
                    $('#searchResult').html(json.result).removeClass('hidden');
                    $('#amount').html(json.amount);
                }
            });
        });
    },

    init: function() {
        if (this.filter.length > 0) {
            this.observer();
        }
    }

};

function checkFields(form) {
    var checks_radios = form.find(':checkbox, :radio'),
        inputs = form.find(':input').not(checks_radios).not('[type="submit"],[type="button"],[type="reset"]');

    var checked = checks_radios.filter(':checked');
    var filled = inputs.filter(function(){
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
        numberOfMonths: 1,
        onClose: function (selectedDate) {
            //$("#to").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#to").datepicker({
        dateFormat: "yy",
        changeYear: true,
        numberOfMonths: 1,
        onClose: function (selectedDate) {
            //$("#from").datepicker("option", "maxDate", selectedDate);
        }
    });

	/* */
	
	$("form").change(function() {
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

	$("#delete").click(function() {
		swal({
		title: "Удалить проект?",
		text: "Вы уверены, что хотите полностью удалить проект?", 
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Да, удалить проект!",
		closeOnConfirm: false
	},
	function(){
		swal("Удалено!", "Проект удалён.", "success");
	});
	})

});