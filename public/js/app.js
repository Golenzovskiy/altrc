$(document).ready(function () {
    $("#from").datepicker({
        dateFormat: "dd.mm.yy",
        defaultDate: -365,
        changeYear: true,
        numberOfMonths: 1,
        onClose: function (selectedDate) {
            $("#to").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#to").datepicker({
        dateFormat: "dd.mm.yy",
        changeYear: true,
        numberOfMonths: 1,
        onClose: function (selectedDate) {
            $("#from").datepicker("option", "maxDate", selectedDate);
        }
    });

	/* */
	
	$("form").change(function() {
		$(this).find("button").removeAttr("disabled");
	});
	
	function checkFields(form) {
		var checks_radios = form.find(':checkbox, :radio'),
		inputs = form.find(':input').not(checks_radios).not('[type="submit"],[type="button"],[type="reset"]'); 
	
		var checked = checks_radios.filter(':checked');
		var filled = inputs.filter(function(){
			return $.trim($(this).val()).length > 0;
		});
		
		if(checked.length + filled.length === 0) {
			return false;
		}
		
	return true;
	}
	
	$(function(){
		$('#form').on('submit',function(e){
			e.preventDefault();
			var oneFilled = checkFields($(this));
			if(oneFilled) {
				alert('одно заполнено');
			} else {
				alert('везде пусто');
			}
		});
	});
	
	/* */

    $('#filter').click(function (e) {
        e.preventDefault();
        var l = Ladda.create(this);
        l.start();
        $.post("filter.php",
            {data: $('form').serialize()},
            function (response) {
                $('#amount').text(response.amount);
                $("#searchResult").removeClass('hidden');
            }, "json")
            .always(function () {
                l.stop();
            });
        return false;
    });

    var sampleTags = ['пищёвка', 'стройка', 'абвгд', 'еёжз'];
    $('#FieldTags').tagit({
        availableTags: sampleTags
    });

    $('[data-toggle="tooltip"]').tooltip();

    $(".tag").on("click", function () {
        var selectedTag = $(this).data("tag");
        $("#filterResult").find("tr[data-tags]").each(function () {
            if ($.inArray(selectedTag, $(this).data('tags')) == -1) {
                $(this).addClass('hidden').next().addClass('hidden');                
            }
        })
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