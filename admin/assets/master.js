/* Live Search */
var itemid = ($.url(true).param('id')) ? $.url(true).param('id') : 0 ;
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
        cursorborderradius:2,
        autohidemode: true
    });

	/* == Help Sidebar == */
	$('body').on('click', '.helper', function () {
	    var div = $(this).data('help');
	    $('.sidebar').sidebar('toggle').addClass('loading');
	    setTimeout(function () {
	        $('.sidebar').load('help/help.php #' + div + '-help');
	        $('.sidebar').removeClass('loading');
	    }, 500);
		$('.wojo.sidebar').niceScroll({railalign:'left'});
	})
	
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

    /* == Editor == */
    $('.post').redactor({
        observeLinks: true,
        wym: true,
        plugins: ['fullscreen']
    });

	$('.altpost').redactor({
		observeLinks: true,
		minHeight: 100,
		buttons: ['formatting', 'bold', 'italic', 'unorderedlist', 'orderedlist', 'outdent', 'indent'],
		wym: true
	});
	
    /* == Submit Search by date == */
    $("#doDates").on('click', function () {
        $("#admin_form").submit();
        return false;
    });

    /* == Master Form == */
    $('body').on('click', 'button[name=dosubmit]', function () {
        function showResponse(json) {
            $(".wojo.form").removeClass("loading");
            $("#msgholder").html(json.message);
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

    /* == Delete Multiple == */
    $('body').on('click', 'button[name=mdelete]', function () {
        function showResponse(json) {
            $("button[name='mdelete']").removeClass("loading");
            $('.wojo.table tbody tr').each(function () {
                if ($(this).find('input:checked').length) {
                    $(this).fadeOut(400, function () {
                        $(this).remove();
                    });
                }
            });
            $("#msgholder").html(json.message);
        }

        function showLoader() {
            $("button[name='mdelete']").addClass("loading");
            $('.wojo.table tbody tr').each(function () {
                if ($(this).find('input:checked').length) {
                    $(this).animate({
                        'backgroundColor': '#FFBFBF'
                    }, 400);
                }
            });

        }
        var posturl = "controller.php";
        var options = {
            target: "#msgholder",
            beforeSubmit: showLoader,
            success: showResponse,
            type: "post",
            url: posturl,
            dataType: 'json'
        };

        $('#wojo_form').ajaxForm(options).submit();
    });

    /* == Delete Item == */
    $('body').on('click', 'a.delete', function () {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var title = $(this).data('title');
        var option = $(this).data('option');
        var parent = $(this).parent().parent();

        new Messi("<div class=\"messi-warning\"><i class=\"massive icon warn warning sign\"></i></p><p>Are you sure you want to delete this record?<br><strong>This action cannot be undone!!!</strong></p></div>", {
            title: title,
            titleClass: '',
            modal: true,
            closeButton: true,
            buttons: [{
                id: 0,
                label: 'Delete Record',
                class: 'negative',
                val: 'Y'
            }],
            callback: function (val) {
                $.ajax({
                    type: 'post',
                    url: "controller.php",
                    dataType: 'json',
                    data: {
                        id: id,
                        delete: option,
                        title: encodeURIComponent(name)
                    },
                    beforeSend: function () {
                        parent.animate({
                            'backgroundColor': '#FFBFBF'
                        }, 400);
                    },
                    success: function (json) {
                        parent.fadeOut(400, function () {
                            parent.remove();
                        });
                        $.sticky(decodeURIComponent(json.message), {
                            type: json.type,
                            title: json.title
                        });
                    }

                });
            }
        });
    });

    /* == Submit Search by date == */
    $("#doDates").on('click', function () {
        $("#wojo_form").submit();
        return false;
    });

    /* == Listing Search == */
    $("#searchfield").on('keyup', function () {
        var srch_string = $(this).val();
        var data_string = 'listingSearch=' + srch_string;
        if (srch_string.length > 4) {
            $.ajax({
                type: "post",
                url: "controller.php",
                data: data_string,
                beforeSend: function () {

                },
                success: function (res) {
                    $('#suggestions').html(res).show();
                    $("input").blur(function () {
                        $('#suggestions').fadeOut();
                    });
                }
            });
        }
        return false;
    });

    /* == Sticky Footer == */
    var docHeight = $(window).height();
    var footerHeight = $('footer').height();
    var footerTop = $('footer').position().top + footerHeight;
    if (footerTop < docHeight) {
        $('footer').css('margin-top', (docHeight - footerTop) + 'px');
    }

    /* == Inline Edit == */
    $('body').on('focus', 'span[contenteditable=true]', function () {
        $(this).data("initialText", $(this).text());
        $('span[contenteditable=true]').not(this).removeClass('active');
        $(this).toggleClass("active");
    }).on('blur', 'span[contenteditable=true]', function () {
        if ($(this).data("initialText") !== $(this).text()) {
            title = $(this).text();
            type = $(this).data("edit-type");
            id = $(this).data("id")
            $this = $(this);
            $.ajax({
                type: "POST",
                url: "controller.php",
                data: ({
                    'title': title,
                    'type': type,
                    'id': id,
                    'quickedit': 1
                }),
                beforeSend: function () {
                    $this.text('working...').animate({
                        opacity: 0.2
                    }, 800);
                },
                success: function (res) {
                    $this.animate({
                        opacity: 1
                    }, 800);
                    setTimeout(function () {
                        $this.html(res).fadeIn("slow");
                    }, 1000);
                }
            })
        }
    });
});




$(document).on('dragover', function (e) {
    var dropZone = $('#drop'),
        timeout = window.dropZoneTimeout;
    if (!timeout) {
        dropZone.addClass('in');
    } else {
        clearTimeout(timeout);
    }
    var found = false,
        node = e.target;
    do {
        if (node === dropZone[0]) {
            found = true;
            break;
        }
        node = node.parentNode;
    } while (node != null);
    if (found) {
        dropZone.addClass('hover');
    } else {
        dropZone.removeClass('hover');
    }
    window.dropZoneTimeout = setTimeout(function () {
        window.dropZoneTimeout = null;
        dropZone.removeClass('in hover');
    }, 100);
});

function formatFileSize(bytes) {
    if (typeof bytes !== 'number') {
        return '';
    }

    if (bytes >= 1000000000) {
        return (bytes / 1000000000).toFixed(2) + ' GB';
    }

    if (bytes >= 1000000) {
        return (bytes / 1000000).toFixed(2) + ' MB';
    }

    return (bytes / 1000).toFixed(2) + ' KB';
}