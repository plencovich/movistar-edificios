$(document).ready(function () {

  var $alertNotification = $("#alertNotification");

  function clearNotification() {
    $alertNotification.removeClass().addClass('hidden').empty();
  }

  function pushNotification(successData) {
    clearNotification();
    $alertNotification.addClass(successData.classMain).removeClass('hidden');
    $alertNotification.append(successData.message);
  }

  function addClassError(successData, formID) {
    var campos = successData.errors.replace(/\s+/g, '').split('|').filter(function (e) {
      return e === 0 || e
    });

    for (x = 0; x < campos.length; x++) {
      if (campos.indexOf(campos[x]) >= 0) {
        $(formID).find("#" + campos[x]).addClass("has-error");
      }
    }

    $(".has-error").bind("change keyup input", function () {
      var campo = $(this).attr('id');
      $("#" + campo).removeClass("has-error");
      clearNotification(formID);
    });
  }

  if ($(".sDate").length != 0) {
    $('.sDate').dateDropper();
  }

  if ($("#plano_attach").length != 0) {
    $("#plano_attach input:file").change(function () {
      if ($(this).get(0).files.length != 0) {
        $('#attach_file').val('1')
      } else {
        $('#attach_file').val('0');
      }
    });
  }

  if ($(".btnSubmit").length != 0) {
    $("form").on("submit", function (e) {
      e.preventDefault();
      var form = $(this).attr('id');
      var formID = "#" + form;

      if ($('#btn_focus_type').length != 0) {
        var btnType = $(this).find("button[type=submit]:focus").attr('data-type-btn');
        $("input[name=btn_focus_type").val(btnType);
      }

      var formAction = $(this).attr('action');
      var dataString = new FormData(this);
      var btn = Ladda.create(document.querySelector(formID + ' .btnSubmit'));

      btn.start();
      show_loading();
      $.ajax({
        type: "POST",
        url: formAction,
        data: dataString,
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
      })
      .done(function (successData) {
        if (successData.validation == false) {
          switch (successData.type) {
            case "login":
            case "recovery":
            case "reset_password":
            case "register":
              pushNotification(successData);
              addClassError(successData, formID);
              swal.close();
            break;

            case "validation":
              swalError(successData, btn);
              addClassError(successData, formID);
            break;

            default:
              swalError(successData, btn);
            break;
          }
        } else {
          if (successData.status == true) {
            switch (successData.type) {
              case "login":
              case "formRedir":
                $("body").fadeOut("fast", function () {
                  $(location).prop('href', successData.redirUrl);
                });
              break;

              case "recovery":
              case "register":
                pushNotification(successData);
                $(formID).trigger("reset");
                swal.close();
              break;

              default:
                swalOk(successData);
              break;
            }
          } else {
            pushNotification(successData);
            swal.close();
          }
        }
          btn.stop();
      })
      .fail(function (xhr) {
        serverError(btn);
        console.log(xhr.responseText);
      })
    });
  }
});
