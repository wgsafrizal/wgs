

  $(document).ready(function() {
  


    // Inisialisasi Select2 untuk #satuan
    $('#class').select2({
      allowClear: true // Aktifkan ini jika ingin memungkinkan penghapusan nilai
    });

    // Tambahkan teks atau placeholder manual untuk satuan
    $('#class').append('<option value="" disabled selected>Class</option>');

    // Ambil data satuan dari database
    $.ajax({
      url: 'get_classes.php',
      dataType: 'json',
      success: function(data) {
        // Isi Select2 dengan data satuan
        $.each(data, function(index, value) {
          $('#class').append('<option value="' + value + '">' + value + '</option>');
        });
      }
    });





    // Inisialisasi Select2 untuk #satuan
    $('#satuan').select2({
      allowClear: true // Aktifkan ini jika ingin memungkinkan penghapusan nilai
    });

    // Tambahkan teks atau placeholder manual untuk satuan
    $('#satuan').append('<option value="" disabled selected>Unit</option>');

    // Ambil data satuan dari database
    $.ajax({
      url: 'get_mastersatuan.php',
      dataType: 'json',
      success: function(data) {
        // Isi Select2 dengan data satuan
        $.each(data, function(index, value) {
          $('#satuan').append('<option value="' + value + '">' + value + '</option>');
        });
      }
    });










  });
