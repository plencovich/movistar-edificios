$(document).ready(function(){
    if ($("#place_item_location").length != 0) {
        var geocoder;
        var map;
        var marker;

        /*
         * Google Map with marker
         */
        function initialize() {
            var initialLat = $('.search_latitude').val();
            var initialLong = $('.search_longitude').val();
            initialLat = initialLat ? initialLat : -34.6033848;
            initialLong = initialLong ? initialLong : -58.3768586;
            var latlng = new google.maps.LatLng(initialLat, initialLong);
            var options = {
                zoom: 16,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("geomap"), options);

            geocoder = new google.maps.Geocoder();

            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                position: latlng
            });

            geocoder.geocode({
              'latLng': marker.getPosition()
            }, function (results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                marker.setPosition(results[0].geometry.location);
                strip_address(results[0]);
                $('.search_latitude').val(marker.getPosition().lat()).change();
                $('.search_longitude').val(marker.getPosition().lng()).change();
              }
            });

            google.maps.event.addListener(marker, "dragend", function () {
                var point = marker.getPosition();
                map.panTo(point);
                geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location);
                        marker.setPosition(results[0].geometry.location);
                        strip_address(results[0]);
                        $('.search_latitude').val(marker.getPosition().lat()).change();
                        $('.search_longitude').val(marker.getPosition().lng()).change();
                    }
                });
            });

        }

        function strip_address(results) {
            var arrAddress = results.address_components;
            var itemRoute='';
            var itemLocality='';
            var itemState='';
            var itemSnumber='';

            $.each(arrAddress, function (i, address_component) {

                if (address_component.types[0] == "route"){
                    itemRoute = address_component.long_name;
                }

                if (address_component.types[0] == "locality"){
                    itemLocality = address_component.long_name;
                }

                if (address_component.types[0] == "administrative_area_level_1"){
                    itemState = address_component.long_name;
                }

                if (address_component.types[0] == "street_number"){
                    itemSnumber = address_component.long_name;
                }
                $('.search_addr').val(itemRoute+' '+itemSnumber).change();
                $('.search_city').val(itemLocality).change();
                $('.search_state').val(itemState).change();
            });
        }

        //google.maps.event.addDomListener(window, 'load', initialize);

        $(document).ready(function () {
            //load google map
            initialize();

            /*
             * autocomplete location search
             */
            var PostCodeid = '#search_location';
            $(function () {
                $(PostCodeid).autocomplete({
                    source: function (request, response) {
                        geocoder.geocode({
                            'address': request.term,
                            componentRestrictions: {country: "ar"}
                        }, function (results, status) {
                            response($.map(results, function (item) {
                                strip_address(item);
                                return {
                                    label: item.formatted_address,
                                    value: item.formatted_address,
                                    lat: item.geometry.location.lat(),
                                    lon: item.geometry.location.lng()
                                };
                            }));
                        });
                    },
                    select: function (event, ui) {
                        $('.search_latitude').val(ui.item.lat).change();
                        $('.search_longitude').val(ui.item.lon).change();
                        var latlng = new google.maps.LatLng(ui.item.lat, ui.item.lon);
                        marker.setPosition(latlng);
                        initialize();
                    }
                });
            });

            /*
             * Point location on google map
             */
            $('.get_map').click(function (e) {
                var address = $(PostCodeid).val();
                geocoder.geocode({'address': address}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location);
                        marker.setPosition(results[0].geometry.location);
                        strip_address(results[0]);
                        $('.search_latitude').val(marker.getPosition().lat()).change();
                        $('.search_longitude').val(marker.getPosition().lng()).change();
                    } else {
                        alert("Geocode was not successful for the following reason: " + status);
                    }
                });
                e.preventDefault();
            });

            //Add listener to marker for reverse geocoding
            google.maps.event.addListener(marker, 'drag', function () {
                geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            strip_address(results[0]);
                            $('.search_latitude').val(marker.getPosition().lat()).change();
                            $('.search_longitude').val(marker.getPosition().lng()).change();
                        }
                    }
                });
            });
        });
    }
});
