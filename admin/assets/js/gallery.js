  $(document).ready(function () {
      /* == Upload File == */
      var ul = $('#upload ul');
      $('#drop a').click(function () {
          $(this).parent().find('input').click();
      });

      $('#upload').fileupload({
          dropZone: $('#drop'),
          limitMultiFileUploads: 5,
          sequentialUploads: true,

          add: function (e, data) {
              var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48" data-fgColor="#58AC80" data-readOnly="1" data-bgColor="#ffffff" /><p><small></small></p><span></span></li>');

              tpl.find('p').text(data.files[0].name)
                  .append('<small></small>')
                  .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

              data.context = tpl.appendTo(ul);
              tpl.find('input').knob();
              tpl.find('span').click(function () {

                  if (tpl.hasClass('working')) {
                      jqXHR.abort();
                  }

                  tpl.fadeOut(function () {
                      tpl.remove();
                  });

              });

              var jqXHR = data.submit().success(function (result, textStatus, jqXHR) {
                  var json = JSON.parse(result);
                  var status = json['status'];

                  if (status == 'error') {
                      data.context.addClass('error');
                      data.context.find('span').addClass('ferror');
                      data.context.find('small').append(json['msg']);
                  } else {
                      $(".wojo.info.message").remove();
                      $("#gallery").prepend(json['msg']);
                      $("img", ".wojo.reveal").each(function () {
                          $(this).load(function () {
                              $mask = $(this).parent().parent().find('.mask');
                              var height = $(this).height();
                              $($mask).css("height", height);
                          });
                      });
                      $('.lightbox').magnificPopup({
                          type: 'image'
                      });
                  }
                  //console.log(json)
              });
          },

          progress: function (e, data) {
              var progress = parseInt(data.loaded / data.total * 100, 10);
              data.context.find('input').val(progress).change();
              if (progress == 100) {
                  data.context.removeClass('working');
              }
          },

          fail: function (e, data) {
              data.context.addClass('error');
          }

      });

      /* == Delete Item == */
      $('body').on('click', 'a.imgdelete', function () {
          var id = $(this).data('id');
          var name = $(this).data('name');
          var lid = $(this).data('lid');
          var parent = $(this).closest('.row');

          new Messi("<div class=\"messi-warning\"><i class=\"massive icon warn warning sign\"></i></p><p>Are you sure you want to delete this record?<br><strong>This action cannot be undone!!!</strong></p></div>", {
              title: 'Delete Image',
              titleClass: '',
              modal: true,
              closeButton: true,
              buttons: [{
                  id: 0,
                  label: 'Delete',
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
						  lid: lid,
                          deletePhoto: 1,
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
  });