$(document).ready(function () {
  if ($("#registerUser").length != 0 || $("#user_sheet").length != 0) {

    function emptySelectCity($type) {
      var labelSelect = ($type == 0 ? '-- Primero Seleccione una Provincia -- ' : '-- Seleccione una Ciudad -- ');
      $('select[name=city_id]').empty().append($('<option>', {
        value: '0',
        text: labelSelect
      }));
    }

    var actionGenerate = $('#state_id').attr('data-action-city');

    $("select[name=state_id]").change(function () {
      $(this).find("option:selected").each(function () {
        var state_id = this.value;
        if (state_id != 0) {
          $.ajax({
            type: "POST",
            url: actionGenerate + state_id,
            dataType: "json",
            cache: false
          }).done(function (data) {
            if (data.city_list != null) {
              emptySelectCity(1);
              $.each(data.city_list, function (i, item) {
                $('select[name=city_id]').append($('<option>', {
                  value: item.id_ciudad,
                  text: item.descrip
                }));
              });
              change_city();
            }
          }).error(function (xhr) {
            serverError();
            console.log(xhr.responseText);
          });
        } else {
          emptySelectCity(0);
        }
      });
    });

    if ($("#user_sheet").length != 0) {
      $state_id_selected = $("input[name=state_id_selected]");
      if ($state_id_selected.length != 0) {
        state_id_selected_val = $state_id_selected.val();
        $("select[name=state_id]").val(state_id_selected_val).change();
      }

      function change_city() {
        $city_id_selected = $("input[name=city_id_selected]");
        if ($city_id_selected.length != 0) {
          city_id_selected_val = $city_id_selected.val();
          $("select[name=city_id]").val(city_id_selected_val).change();
        }
      }
    }
  }
});
