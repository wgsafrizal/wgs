$(document).ready(function () {
    $('#kodeproduksi').select2({
        ajax: {
            url: 'get_kodeproduksi.php',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                console.log(data); // Log the received data to the console
                return {
                    results: data
                };
            },
            cache: true
        },
        language: {
            searching: function () {
                return 'Mencari...';
            }
        },
        placeholder: 'Cari...',
        minimumInputLength: 0,
        allowClear: true,
        formatNoMatches: function () {
            return 'Tidak ditemukan hasil';
        }
    });
});









function carispk() {
    // Get the selected nama barang
    var selectedKodeProduksi = $("#kodeproduksi").val();

    // Make an AJAX request to get the corresponding kodebarang
    $.ajax({
        type: "GET",
        url: "get_spk.php", // Replace with the actual server-side script to handle the data
        data: { kodeproduksi: selectedKodeProduksi },
        dataType: 'json',
        success: function(response) {
            // Update the hidden input field with the fetched kodebarang

            $("#spk").val(response.spk);

          
        },
        error: function(error) {
            // Handle errors, if any
            console.error(error);
        }
    });
}








