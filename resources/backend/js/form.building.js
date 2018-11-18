$(document).ready(function () {
  if ($("#addBuilding").length != 0) {

    function emptySelectCity($type) {
      var labelSelect = ($type == 0 ? '-- Primero Seleccione una Provincia -- ' : '-- Seleccione una Ciudad -- ');
      $('select[name=city_id]').empty().append($('<option>', {
        value: '0',
        text: labelSelect
      }));
    }
    function emptySelectRegion($type) {
      var labelSelect = ($type == 0 ? '-- Primero Seleccione una Provincia -- ' : '-- Seleccione un Partido -- ');
      $('select[name=region_id]').empty().append($('<option>', {
        value: '0',
        text: labelSelect
      }));
    }
    function emptySelectStreet($type) {
      var labelSelect = ($type == 0 ? '-- Primero Seleccione una Ciudad -- ' : '-- Seleccione una Calle -- ');
      $("select[name^='street_id']").empty().append($('<option>', {
        value: '0',
        text: labelSelect
      }));
    }
    var actionGenerate = $('#state_id').attr('data-action-city-region');

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
              emptySelectRegion(1);
              $.each(data.city_list, function (i, item) {
                $('select[name=city_id]').append($('<option>', {
                  value: item.id_ciudad,
                  text: item.descrip
                }));
              });
              $.each(data.region_list, function (i, item) {
                $('select[name=region_id]').append($('<option>', {
                  value: item.id_partido,
                  text: item.descrip
                }));
              });
              change_city();
              change_region();
            }
          }).error(function (xhr) {
            serverError();
            console.log(xhr.responseText);
          });
        } else {
          emptySelectCity(0);
          emptySelectRegion(0);
        }
      });
    });

    var actionGenerateStreet = $('#city_id').attr('data-action-street');
    $("select[name=city_id]").change(function () {
      $(this).find("option:selected").each(function () {
        var city_id = this.value;
        if (city_id != 0) {
          $.ajax({
            type: "POST",
            url: actionGenerateStreet + city_id,
            dataType: "json",
            cache: false
          }).done(function (data) {
            emptySelectStreet(1);
            if (data.street_list != null) {
              $('#noStreetFound').addClass('hidden');
              $('input[name=custom_address]').val(0);
              $("*[id^='street_id']").not('#street_id_df').removeClass('hidden');
              $.each(data.street_list, function (i, item) {
                $("select[name^='street_id']").append($('<option>', {
                  value: item.cd_calle,
                  text: item.descrip
                }));
              });
              change_street();
            } else {
              $("*[id^='street_id']").addClass('hidden');
              $('#noStreetFound').removeClass('hidden');
              $('input[name=custom_address]').val(1);
            }
          }).error(function (xhr) {
            serverError();
            console.log(xhr.responseText);
          });
        } else {
          emptySelectStreet(0);
        }
      });
    });

    $('input[name=add_altura_desde]').blur(function () {
      var selStreet = $('select[name=street_id] :selected').text();
      var addresNumber = $('input[name=add_altura_desde]').val();
      var selCity = $('select[name=city_id] :selected').text();
      var selState = $('select[name=state_id] :selected').text();
      $('#search_location').val(selStreet + ' ' + addresNumber + ',' + selCity + ',' + selState).change();
    });

    $('input[name=add_doble_frente]').on('ifChecked', function (event) {
      if ($(this).val() == 1) {
        $('#street_id_df').removeClass('hidden');
      } else {
        $('#street_id_df').addClass('hidden');
      }
    });

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

    function change_region() {
      $region_id_selected = $("input[name=region_id_selected]");
      if ($region_id_selected.length != 0) {
        region_id_selected_val = $region_id_selected.val();
        $("select[name=region_id]").val(region_id_selected_val).change();
      }
    }

    function change_street() {
      $street_id_selected = $("input[name=street_id_selected]");
      if ($street_id_selected.length != 0) {
        street_id_selected_val = $street_id_selected.val();
        $("select[name=street_id]").val(street_id_selected_val).change();
      }

      $street_id_df_selected = $("input[name=street_id_df_selected]");
      if ($street_id_df_selected.length != 0) {
        street_id_df_selected_val = $street_id_df_selected.val();
        $("select[name=street_id_df]").val(street_id_df_selected_val).change();
      }

      $street_id_one_selected = $("input[name=street_id_one_selected]");
      if ($street_id_one_selected.length != 0) {
        street_id_one_selected_val = $street_id_one_selected.val();
        $("select[name=street_id_one]").val(street_id_one_selected_val).change();
      }
      $street_id_two_selected = $("input[name=street_id_two_selected]");
      if ($street_id_two_selected.length != 0) {
        street_id_two_selected_val = $street_id_two_selected.val();
        $("select[name=street_id_two]").val(street_id_two_selected_val).change();
      }
      $street_id_three_selected = $("input[name=street_id_three_selected]");
      if ($street_id_three_selected.length != 0) {
        street_id_three_selected_val = $street_id_three_selected.val();
        $("select[name=street_id_three]").val(street_id_three_selected_val).change();
      }
    }
  }
});
