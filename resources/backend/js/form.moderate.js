$(document).ready(function () {

  $("body").on("click", ".moderate", function () {
    show_loading();
    var tagType = $(this).attr("data-tagtype");
    var action = $("#infoActions").attr("data-action-" + tagType);
    var itemParent = $(this).closest('a');
    var itemId = $(this).closest('td').attr("data-item-id");
    var status = $(this).attr("data-status");
    var dataString = {
      item_id: itemId,
      status: status
    };

    $.ajax({
      type: "POST",
      url: action,
      dataType: "json",
      data: dataString,
      cache: false
    })
    .done(function (data) {
      $(itemParent).empty().append('<i class="' + data.icon + '"></i>');
      $(itemParent).attr("data-status", data.new_status);
      swal.close();
    })
    .fail(function (xhr) {
      console.log(xhr.responseText);
      serverError();
      swal.close();
    });
  });
});
