$(document).ready(function () {
    $('#btnAdd').click(function () {
        var num = $('.clonedInput').length;
        var newNum = new Number(num + 1);
        var newElem = $('#container' + num).clone().attr('id', 'container' + newNum);
        $('#container' + num).after(newElem);
        $('#btnDel').prop('disabled', false);
        if (newNum == 15) $('#btnAdd').prop('disabled', true);
    });
    $('#btnDel').click(function () {
        var num = $('.clonedInput').length;
        $('#container' + num).remove();
        $('#btnAdd').attr('disabled', false);
        if (num - 1 == 1) $('#btnDel').prop('disabled', true);
    });
    $('#btnDel').prop('disabled', 'disabled');
    $("#droplist-makes").chosen().change(function () {
        ($(this).val() == "") ? window.location.href = 'index.php?do=models' : window.location.href = 'index.php?do=models&id=' + $(this).val();
    });

    $("#doModelSearch").on('click', function () {
        $("#wojo_form").submit();
        return false;
    });
	
    $('a#dosubmit').on('click', function () {
        var values = $('.addmore :input').serialize();
        values += "&processModel=1";
        values += "&makeid=" + itemid;
        $.ajax({
            type: 'post',
            url: "controller.php",
            dataType: 'json',
            data: values,
            success: function (json) {
				if (json.type == "success") {
					$(".wojo.info.message").remove();
					$(json.data).insertBefore('.wojo.table tbody tr:first');
					$(".addmore").slideUp();
					$(".addmore :input").val('');
				}
				$.sticky(decodeURIComponent(json.message), {
					type: json.type,
					title: json.title
				});
            }
        });
    });
});