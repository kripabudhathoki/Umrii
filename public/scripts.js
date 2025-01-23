$(document).ready(function () {
    const BASE_URL = "https://cors-anywhere.herokuapp.com/https://nominatim.openstreetmap.org/search?format=json&limit=5&bounded=1&viewbox=85.272,27.747,85.367,27.661&q=La&countrycodes=np&bounded=1";



    // Location suggestion handling
    $('#address').on('input', function () {
        const query = $(this).val();
        if (query.length < 2) {
            $('#suggestions').hide();
            return;
        }
        $.getJSON(`${BASE_URL}&q=${query}&countrycodes=np&bounded=1`, function (data) {
            $('#suggestions').empty().show();
            data.forEach(item => {
                const suggestion = $('<div class="suggestion-item"></div>').text(item.display_name);
                suggestion.on('click', function () {
                    $('#address').val(item.display_name);
                    $('#suggestions').hide();
                    calculateDeliveryCost(item.lat, item.lon);
                });
                $('#suggestions').append(suggestion);
            });
        });
    });

    // Delivery cost calculation
    function calculateDeliveryCost(lat, lon) {
        const shopLat = 27.7172;
        const shopLon = 85.3240;

        const R = 6371;
        const dLat = (lat - shopLat) * Math.PI / 180;
        const dLon = (lon - shopLon) * Math.PI / 180;

        const a = Math.sin(dLat / 2) ** 2 + Math.cos(shopLat * Math.PI / 180) * Math.cos(lat * Math.PI / 180) * Math.sin(dLon / 2) ** 2;
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        const distance = R * c;

        let deliveryCost;
        if (distance <= 2) {
            deliveryCost = 50;
        } else if (distance <= 8) {
            deliveryCost = 100;
        } else if (distance <= 20) {
            deliveryCost = 200;
        } else {
            alert('We do not deliver beyond 20 km.');
            return;
        }
       
        $.ajax({
            url: 'save_delivery_charge.php',
            method: 'POST',
            data: { delivery_charge: deliveryCost },
            success: function(response) {
                $('#deliveryCost').text(`Delivery Price: Rs. ${deliveryCost}`);
            }
        });

        $('#deliveryCost').text(`Delivery Price: Rs. ${deliveryCost}`);
    }

    // Payment method handling
    $('#cash-on-delivery').click(function (event) {
        event.preventDefault();
        $('#payment-method').val('cod');
        $('#billing-form').submit();
    });

    $('#pay-with-khalti').click(function (event) {
        event.preventDefault();
        $('#payment-method').val('khalti');
        $('#billing-form').submit();
    });
});