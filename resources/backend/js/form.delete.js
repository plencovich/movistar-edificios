$(document).ready(function () {

  $("body").on("click", ".delete", function () {
    var action = $("#infoActions").attr("data-action-delete");
    var itemId = $(this).closest("td").attr("data-item-id");
    var delRow = $(this).closest("tr");
    var dataString = {
      item_id: itemId
    };

    swal({
      title: $("#formDelete").attr("data-title-delete"),
      html: $("#formDelete").attr("data-label-delete"),
      showCancelButton: true,
      confirmButtonColor: "#5cb85c",
      cancelButtonColor: "#ed5565",
      confirmButtonText: $("#formDelete").attr("data-yes"),
      cancelButtonText: $("#formDelete").attr("data-no"),
      confirmButtonClass: "btn btn-success m-l-lg",
      cancelButtonClass: "btn btn-danger",
      buttonsStyling: false,
      reverseButtons: true,
      allowEscapeKey: false,
      allowOutsideClick: false,
      focusConfirm: false,
      focusCancel: false
    }).then(function (result) {
      if (result.value) {
        show_loading();
        $.ajax({
          type: "POST",
          url: action,
          dataType: "json",
          data: dataString,
          cache: false,
        })
        .done(function (data) {
          if (data.status == true) {
            swalDeleteOk(data, delRow);
          } else if (data.status == false) {
            swalDeleteError(data);
          }
        })
        .fail(function (xhr) {
          console.log(xhr.responseText);
          serverError();
        });
      };
    });
  });
});
