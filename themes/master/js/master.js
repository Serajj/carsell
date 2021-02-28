$(document).ready(function () {
    $("select").chosen({
        disable_search_threshold: 10,
        width: "100%"
    });

    $('.wojo.dropdown').dropdown();
    $('body [data-content]').popup();

    $("table.sortable").tablesort();

    $('.filefield').customFileInput();

    $('body [data-datepicker]').pickadate({
        formatSubmit: 'yyyy-mm-dd'
    });
    $('body [data-timepicker]').pickatime({
        formatSubmit: 'HH:i:s'
    });

    /* == Carousel == */
    $(".wojo-carousel").owlCarousel({});

    /* == Lightbox == */
    $('.lightbox').magnificPopup({
        type: 'image'
    });
    $('[data-gallery]').magnificPopup({
        type: 'image',
        mainClass: 'mfp-with-zoom',
        delegate: 'a',
        zoom: {
            enabled: true,
            duration: 300,
            easing: 'ease-in-out',
        },
        gallery: {
            enabled: true
        }
    });

    /* == Scrollbox == */
    $(".chosen-results").niceScroll({
        scrollspeed: 60,
        mousescrollstep: 35,
        cursorwidth: 10,
        cursorcolor: '#B2B2C0',
        cursorborderradius: 2,
        autohidemode: true
    });

    /* == Close Message == */
    $('body').on('click', '.message i.close.icon', function () {
        var $msgbox = $(this).closest('.message')
        $msgbox.slideUp(500, function () {
            $(this).remove()
        });
    });

    /* == Tabs == */
    $(".tab_content").hide();
    $("#tabs a:first").addClass("active").show();
    $(".tab_content:first").show();
    $("#tabs a").on('click', function () {
        $("#tabs a").removeClass("active");
        $(this).addClass("active");
        $(".tab_content").hide();
        var activeTab = $(this).data("tab");
        $(activeTab).show();
        //return false;
    });

    /* == Hover Effect == */
    $("img", ".wojo.reveal").each(function () {
        $(this).load(function () {
            $mask = $(this).parent().parent().find('.mask');
            var height = $(this).height();
            $($mask).css("height", height);
        });
    });

    $("#droplist-make_id").chosen().change(function () {
        var option = $(this).val();
        $.post(SITEURL + '/ajax/controller.php', {
            makelist: option
        }, function (data) {
            $('#droplist-model_id').html(data).trigger("chosen:updated");
        });
    });

    /* == Price Range == */
    $(".range").ionRangeSlider({
        step: 500,
        type: 'double',
        hasGrid: true
    });

    /* == Live Search == */
    $("#liveSearch").on('keyup', function () {
        var srch_string = $(this).val();
        var data_string = 'liveSearch=' + srch_string;
        if (srch_string.length >= 3) {
            $.ajax({
                type: "post",
                url: SITEURL + "/ajax/controller.php",
                data: data_string,
                success: function (res) {
                    $('#suggestions').html(res).show();
                    $("input").on('blur', function () {
                        $('#suggestions').fadeOut();
                    });
                }
            });
        }
        return false;
    });
	
    /* == Newsletter == */
    $('#doNewsletter').on('click', function () {
        var $box = $(this).closest('.wojo.form');
        $box.addClass('loading');
        $.ajax({
            type: "post",
            url: SITEURL + "/ajax/controller.php",
            dataType: 'json',
            data: {
                subscribe: 1,
                email: $("input[name=email_subscribe]").val(),
                action: $("input:radio[name=subscribe]:checked").val()
            },
            success: function (json) {
                if (json.type == "success") {
                    $box.removeClass('loading');
                    $("#scsmsg").html(json.message);
                    $($box).slideUp();
                } else {
                    $box.removeClass('loading');
                    $("#scsmsg").html(json.message);
                }
            }
        });
    });
	
    /* == IE < 10 == */
    $.browser = {};
    $.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        $.browser.version = RegExp.$1;
        if ($.browser.version < 10) {
            $.magnificPopup.open({
                items: {
                    src: '<p class="wojo red segment" style="width:300px;margin:auto; 0">It appears that you are using a <em>very</em> old version of MS Internet Explorer (MSIE) v.' + $.browser.version + '.<br />If you seriously want to continue to use MSIE, at least <a href="http://www.microsoft.com/windows/internet-explorer/">upgrade</a></p>',
                    type: 'inline'
                }
            });
        }
    }
});

$(window).on('resize', function () {
    $(".range").ionRangeSlider('update');
});