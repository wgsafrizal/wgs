$(document).ready(function () {
    $('#namacomponent').select2({
        ajax: {
            url: 'get_namacomponent.php',
            dataType: 'json',
            delay: 250,
            processResults: function (bom) {
                console.log(bom); // Log the received data to the console
                return {
                    results: bom
                };
            },
            cache: true
        },
        language: {
            searching: function () {
                return 'Mencari...';
            }
        },
        placeholder: 'Cari Component...',
        minimumInputLength: 0,
        allowClear: true,
        formatNoMatches: function () {
            return 'Tidak ditemukan hasil';
        }
    });
});

function caribomcomponent() {
    // Get the selected tipeproduksi
    var selectedNamaComponent = $("#namacomponent").val();

    // Make an AJAX request to get the corresponding namabarang and qty
    $.ajax({
        type: "GET",
        url: "get_bomcomponent.php",
        data: { namacomponent: selectedNamaComponent },
        dataType: 'json',
        success: function(response) {
            // Update the input fields with the fetched values
            var namabarang = "";
            var qty = "";

            // Iterate through the response array
            for (var i = 0; i < response.length; i++) {

                namabarang += response[i].namabarang + ", ";
                qty += response[i].qty + ", ";
            }

            // Remove trailing comma and space

            namabarang = namabarang.slice(0, -2);
            qty = qty.slice(0, -2);




            $("#namabarang").val(namabarang);
            $("#qty").val(qty);
        },
        error: function(error) {
            // Handle errors, if any
            console.error(error);
        }
    });
}
