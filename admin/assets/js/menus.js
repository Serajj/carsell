function loadList() {
    $.ajax({
        type: 'get',
        url: "controller.php",
        data: 'getmenus=1',
        cache: false,
        success: function (html) {
            $("#menusort").html(html);
        }
    });
}

$(document).ready(function () {
    $('body').on('click', 'button[name=doMenu]', function () {
        function showResponse(json) {
            $(".wojo.form").removeClass("loading");
            $("#msgholder").html(json.message);
            setTimeout(function () {
                $(loadList()).fadeIn("slow");
            }, 2000);
        }

        function showLoader() {
            $(".wojo.form").addClass("loading");
        }
        var options = {
            target: "#msgholder",
            beforeSubmit: showLoader,
            success: showResponse,
            type: "post",
            url: "controller.php",
            dataType: 'json'
        };

        $('#wojo_form').ajaxForm(options).submit();
    });

    $('body').on('click', "#serialize", function () {
        serialized = $('#menusort').sortable('serialize');
        serialized += '&doMenuSort=1';
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: "controller.php",
            data: serialized,
            success: function (json) {
                $.sticky(decodeURIComponent(json.message), {
                    type: json.type,
                    title: json.title
                });
                setTimeout(function () {
                    $(loadList()).fadeIn("slow");
                }, 2000);
            }
        });
    })

    $('div#menusort').sortable({
        forcePlaceholderSize: true,
        listType: 'ul',
        handle: '.icon.reorder',
        helper: 'clone',
        items: 'li',
        opacity: .6,
        placeholder: 'placeholder',
        tabSize: 25,
        tolerance: 'pointer',
        toleranceElement: '> div'
    });

    $('#contenttype').change(function () {
        var option = $(this).val();
        $.ajax({
            type: 'get',
            url: "controller.php",
            dataType: 'json',
            data: {
                contenttype: option
            },
            success: function (json) {
                if (json.type == "web") {
                    $("#webid").show();
                    $("#contentid").hide();
                    $(json.message).appendTo('#wojo_form');
                } else {
                    $("#contentid").show();
                    $("#webid").hide();
                    $('#page_id').html(json.message).trigger("chosen:updated");
                }
            }
        });
    });
});