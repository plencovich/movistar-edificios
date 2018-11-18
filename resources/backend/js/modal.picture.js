$("body").on("click", ".viewPicture", function () {
  var photoId = $(this).attr('data-photo-id');
  swalModalImg(photoId);
});
