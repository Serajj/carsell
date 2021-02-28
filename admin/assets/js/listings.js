$(document).ready(function () {
    $("#droplist-make_id").chosen().change(function () {
        var option = $(this).val();
        $.post('controller.php', {
            makelist: option
        }, function (data) {
            $('#droplist-model_id').html(data).trigger("chosen:updated");
        });
    });
	
    $('#checkall').click(function (e) {
		var $checkBoxes = $("#features input[type=checkbox]");
        $($checkBoxes).prop("checked",$(this).prop("checked"))
    });

     $('#masterCheckbox').click(function (e) {
		var $checkBoxes = $("input[type=checkbox]");
        $($checkBoxes).prop("checked",$(this).prop("checked"))
    });
});