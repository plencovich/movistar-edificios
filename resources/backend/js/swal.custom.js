function swalOk(successData) {
  swal({
    title: successData.title,
    html: successData.message,
    showCancelButton: false,
    animation: true,
    focusConfirm: false,
    focusCancel: false,
    buttonsStyling: false,
    allowEscapeKey: true,
    allowOutsideClick: true,
    confirmButtonClass: successData.btnClass,
    confirmButtonColor: successData.btnColor
  }).then(function (result) {
    if (result.value) {
      $(location).prop('href', successData.redirUrl);
    }
  });
}

function swalError(successData, btn) {
  swal({
    title: successData.title,
    html: successData.message,
    showCancelButton: false,
    confirmButtonClass: "btn btn-danger",
    animation: true,
    focusConfirm: false,
    focusCancel: false,
    buttonsStyling: false,
    confirmButtonColor: '#ed5565',
    confirmButtonText: 'Cerrar',
    allowOutsideClick: false,
    allowEscapeKey: false
  }).then(function (result) {
    btn.stop();
    swal.close();
  });
}

function serverError(btn) {
  swal({
    title: 'Error',
    html: 'Please, notify your technician. <b>Code(500)</b>',
    showCancelButton: false,
    confirmButtonClass: "btn btn-danger",
    animation: false,
    customClass: 'animated swing',
    focusConfirm: false,
    focusCancel: false,
    buttonsStyling: false,
    confirmButtonColor: '#ed5565',
    confirmButtonText: 'Cerrar',
    allowOutsideClick: false,
    allowEscapeKey: false
  }).then(function (result) {
    if (btn) {
      btn.stop();
    }
    swal.close();
  });
}

function swalDeleteOk(data, delRow) {
  swal({
    title: data.title,
    html: data.message,
    confirmButtonColor: data.btnColor,
    showCancelButton: false,
    confirmButtonClass: "btn btn-success",
    animation: true,
    buttonsStyling: false,
    focusConfirm: false,
    focusCancel: false,
    allowEscapeKey: true,
    allowOutsideClick: true
  }).then(function (result) {
    swal.close();
    $(delRow).fadeOut(400, function () {
      $(this).remove();
    });
  });
}

function swalDeleteError(data) {
  swal({
    title: data.title,
    html: data.message,
    showCancelButton: false,
    confirmButtonClass: "btn btn-danger",
    animation: true,
    focusConfirm: false,
    focusCancel: false,
    buttonsStyling: false,
    confirmButtonColor: data.btnColor,
    confirmButtonText: 'Cerrar',
    allowOutsideClick: false,
    allowEscapeKey: false
  }).then(function (result) {
    swal.close();
  });
}

function swalSimple(successData) {
  swal({
    title: successData.title,
    html: successData.message,
    showCancelButton: false,
    confirmButtonClass: successData.btnClass,
    animation: true,
    focusConfirm: false,
    focusCancel: false,
    buttonsStyling: false,
    allowEscapeKey: false,
    allowOutsideClick: false,
    confirmButtonColor: successData.btnColor,
    confirmButtonText: 'Aceptar'
  }).then(function (result) {
    swal.close();
  });
}

function show_loading() {
  swal({
    html: 'Aguarde un instante...',
    onOpen: function () {
      swal.showLoading();
    }
  });
}

function swalModalImg(imgPath) {
  swal({
    imageUrl: imgPath,
    allowEscapeKey: true,
    allowOutsideClick: true,
    showConfirmButton: false,
    showCloseButton: true,
    focusConfirm: false
  });
}
