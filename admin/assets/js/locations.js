  $(document).ready(function () {
      /* == Delete Item == */
      $('body').on('click', 'a.ldelete', function () {
          var id = $(this).data('id');
          var name = $(this).data('name');
          var parent = $(this).closest('.row');

          new Messi("<div class=\"messi-warning\"><i class=\"massive icon warn warning sign\"></i></p><p>Are you sure you want to delete this record...?<br><strong>This action cannot be undone!!!</strong></p></div>", {
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
                          delete: 'showroom',
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