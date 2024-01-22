$(document).ready(function () {
    $('#satuanEdit').select2({
        ajax: {
            url: 'get_satuann.php',
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


