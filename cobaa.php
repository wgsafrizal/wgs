<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include necessary meta tags and stylesheets -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Contoh Select2</title>

    <!-- Include Select2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>

<body>

    <!-- Example Form -->
    <form>
        <div class="form-group">
            <label for="namabarang">Nama Barang:</label>
            <select class="form-control select2" id="namabarang" name="namabarang" style="width: 100%;">
                <!-- Placeholder option -->
                <option value="">Pilih Nama Barang</option>
            </select>
        </div>

        <!-- Other form elements go here -->

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        // Initialize Select2
        $(document).ready(function () {
            $('#namabarang').select2({
                ajax: {
                    url: 'get_masterbarang.php', // Ganti dengan skrip PHP yang akan memuat daftar barang
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                minimumInputLength: 0,
                placeholder: 'Pilih Nama Barang',
                escapeMarkup: function (markup) {
                    return markup;
                },
                templateResult: function (data) {
                    return data.text;
                },
                templateSelection: function (data) {
                    return data.text;
                }
            });

            // Set focus to search input when the page loads
            $('#namabarang').on('select2:open', function (e) {
                $('.select2-search__field').focus();
            });
        });
    </script>

</body>

</html>
