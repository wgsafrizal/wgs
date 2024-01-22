          

           function showHistory(nosp) {
                    // Mengirim permintaan Ajax ke server untuk mendapatkan tgl_in dan tgl_out
                    $.ajax({
                      type: "POST",
                      url: "get_Historysp.php", // Ganti dengan nama file PHP yang akan menghandle permintaan ini
                      data: {
                        nosp: nosp
                      },
                      success: function(response) {
                        // Menampilkan modal dengan data yang diterima dari server
                        $('#historyModal').find('.modal-body').html(response);
                        $('#historyModal').modal('show');
                      },
                      error: function(xhr, status, error) {
                        console.error("Error:", error);
                      }
                    });
                  }



       function fetchKodeBarang() {
              // Get the selected nama barang
              var selectedNamabarang = $("#namabarang").val();

              // Make an AJAX request to get the corresponding kodebarang
              $.ajax({
                type: "GET",
                url: "get_kodebarang.php", // Replace with the actual server-side script to handle the data
                data: {
                  namabarang: selectedNamabarang
                },
                dataType: 'json',
                success: function(response) {
                  // Update the hidden input field with the fetched kodebarang
                  $("#kodebarang").val(response.kodebarang);

                  // Update the value of sn
                  $("#sn").val(response.sn);


                  // Check the value of sn and update the serialnumber input accordingly
                  checksn();
                },
                error: function(error) {
                  // Handle errors, if any
                  console.error(error);
                }
              });
            }


function saveAllData() {
  // Validate the form before saving changes
  if (!validateForm()) {
    alert('Please fill in all the required fields.');
    return;
  }


  var selectedDate = $("#tglsp").val();
  // Create an array to hold all the rows' data
  var dataToSend = [];

  // Iterate through each row in the table
  $('.table-sp tbody tr').each(function(index, row) {
    var rowData = {

      tglsp: selectedDate,
      namabarang: $(row).find('.namabarang').val(),
      satuan: $(row).find('.satuan').val(),
      qty: $(row).find('.qty').val(),
      divisi: $(row).find('.divisi').val(),
      remarks: $(row).find('.remarks').val()
    };

    // Add the row data to the array
    dataToSend.push(rowData);
  });

  // Send the data to the server using AJAX
  $.ajax({
    type: 'POST',
    url: 'savesp.php', // Replace with your server-side endpoint
    data: { data: JSON.stringify(dataToSend) },
    success: function(response) {
      console.log(response);
      $('#exampleModalScrollable').modal('hide');

      // Display an alert when the data is successfully saved
      alert('Data saved successfully!');

      // Reload the page
      location.reload();
    },
    error: function(error) {
      console.error(error);
      // Handle errors
    }
  });
}


// Function to validate the form before submission
function validateForm() {
  var valid = true;
  // Add your validation logic here
  // For example, check if all required fields are filled

  // Example:
  $('.table-sp tbody tr').each(function(index, row) {
    var itemName = $(row).find('.namabarang').val();
    var divisi = $(row).find('.divisi').val();
    var remarks = $(row).find('.remarks').val();

    if (!itemName || !divisi || !remarks) {
      valid = false;
      return false; // Break out of the loop if any field is empty
    }
  });

  return valid;
}




    
  $(document).ready(function () {
    // Inisialisasi Select2
    $('.divisi').select2({
      ajax: {
        url: 'get_divisi.php',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results: data
          };
        },
        cache: true
      },
      language: {
        searching: function () {
          return 'Searching...';
        }
      },
      placeholder: 'Search Divisi...',
      minimumInputLength: 0, // Allow search with an empty input
      allowClear: true,
      escapeMarkup: function (markup) {
        return markup;
      }, // Let our custom formatter work
      templateResult: function (data) {
        // Customize the appearance of the results
        if (data.loading) {
          return 'Searching...';
        }

        return data.text;
      },
      templateSelection: function (data) {
        // Customize the appearance of the selected option
        return data.text || 'Search Divisi...';
      }
    });
  });



function addRowToModal() {
  var tableBody = document.querySelector(".table-sp tbody");
  var newRow = tableBody.insertRow(tableBody.rows.length);

  var cell1 = newRow.insertCell(0);
  var cell2 = newRow.insertCell(1);
  var cell3 = newRow.insertCell(2);
  var cell4 = newRow.insertCell(3);
  var cell5 = newRow.insertCell(4);
  var cell6 = newRow.insertCell(5);
  var cell7 = newRow.insertCell(6);

  // Generate a unique ID for each select element
  var uniqueIdNamabarang = 'namabarang_' + tableBody.rows.length;
  var uniqueIdDivisi = 'divisi_' + tableBody.rows.length;
  var uniqueIdKodeProduksi = 'kodeproduksi_' + tableBody.rows.length;
  var uniqueIdSpk = 'spk_' + tableBody.rows.length;

  cell1.innerHTML = `<td>
                        <select id="${uniqueIdNamabarang}" class="namabarang" style="width: 500px; font-size: 14px; height: 34px;" required data-placeholder="Search Items Name ..." onchange="updateSatuan(this)"></select>
                     </td>`;

  setTimeout(function () {
    $('#' + uniqueIdNamabarang).select2({
      ajax: {
        url: 'get_namabarang.php',
        dataType: 'json',
        delay: 250,
        processResults: function(data) {
          return {
            results: data
          };
        },
        cache: true
      },
      language: {
        searching: function() {
          return 'Mencari...';
        }
      },
      placeholder: 'Cari nama barang...',
      minimumInputLength: 0,
      allowClear: true,
      formatNoMatches: function() {
        return 'Tidak ditemukan hasil';
      }
    });
  }, 0);

  cell2.innerHTML = '<td><input readonly style="width: 60px;" type="text" name="satuan[]" value="" class="satuan form-control form-control-sm mb-3"></td>';
  cell3.innerHTML = '<td><input type="number" style="width: 60px;" autocomplete="off" required class="qty form-control form-control-sm mb-3" name="qty[]" value="" min="1" max=""></td>';

  cell4.innerHTML = `<td>
                        <select id="${uniqueIdDivisi}" name="divisi[]" class="divisi" style="width: 80px; font-size: 14px; height: 34px;" required data-placeholder="Search Divisi ..."></select>
                     </td>`;

  // Initialize Select2 for the newly added divisi select element
  setTimeout(function () {
    $('#' + uniqueIdDivisi).select2({
      ajax: {
        url: 'get_divisi.php',
        dataType: 'json',
        delay: 250,
        processResults: function(data) {
          return {
            results: data
          };
        },
        cache: true
      },
      language: {
        searching: function() {
          return 'Searching...';
        }
      },
      placeholder: 'Search Divisi...',
      minimumInputLength: 0,
      allowClear: true,
      escapeMarkup: function(markup) {
        return markup;
      },
      templateResult: function(data) {
        if (data.loading) {
          return 'Searching...';
        }
        return data.text;
      },
      templateSelection: function(data) {
        return data.text || 'Search Divisi...';
      }
    });
  }, 0);

  cell5.innerHTML = `<td>
                        <select class="kodeproduksi form-control select2" style="width: 100%;" required data-placeholder="Cari kodeproduksi..." onchange="carispk(this)"></select>
                    </td>`;

  // Initialize Select2 for the newly added kodeproduksi select element
  setTimeout(function () {
    $('.kodeproduksi').select2({
      ajax: {
        url: 'get_kodeproduksi.php', // Change the URL accordingly
        dataType: 'json',
        delay: 250,
        processResults: function(data) {
          return {
            results: data
          };
        },
        cache: true
      },
      language: {
        searching: function() {
          return 'Searching...';
        }
      },
      placeholder: 'Cari kodeproduksi...',
      minimumInputLength: 0,
      allowClear: true,
      formatNoMatches: function() {
        return 'Tidak ditemukan hasil';
      }
    });
  }, 0);

  cell6.innerHTML = `<td>
                        <input readonly type="text" name="nospk[]" autocomplete="off" class="remarks form-control form-control-sm mb-3" id="${uniqueIdSpk}">
                    </td>`;

  cell7.innerHTML = '<td><textarea id="remarks" name="remarks[]" class="remarks form-control" style="font-size: 14px;" rows="3" required placeholder=""></textarea></td>';
}




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













  // Function to update satuan when namabarang changes
  function updateSatuan(selectElement) {
    // Get the selected value
    var namabarang = $(selectElement).val();

    // Send AJAX request to the PHP script to get satuan
    $.ajax({
      url: 'get_satuan.php', // Adjust the URL based on your server-side script
      method: 'GET',
      dataType: 'json',
      data: {
        namabarang: namabarang
      },
      success: function(response) {
        // Update the satuan column value for the current row
        var row = $(selectElement).closest('tr');
        row.find('.satuan').val(response.satuan);
      },
      error: function() {
        // Handle errors if the request fails
        console.log('Failed to fetch satuan data');
      }
    });
  }

  function deleteRow() {
    var table = document.querySelector(".table-sp tbody");
    if (table.rows.length > 1) {
      table.deleteRow(table.rows.length - 1);
    }
  }

  function saveChanges() {
    // Add your logic to save changes here
  }


            $(document).ready(function() {
              // Inisialisasi Select2
              $('.namabarang').select2({
                ajax: {
                  url: 'get_namabaranglocal.php',
                  dataType: 'json',
                  delay: 250,
                  processResults: function(data) {
                    return {
                      results: data
                    };
                  },
                  cache: true
                },
                language: {
                  searching: function() {
                    return 'Mencari...';
                  }
                },




                placeholder: 'Cari nama barang...',
                minimumInputLength: 0, // Allow search with an empty input
                allowClear: true,
                formatNoMatches: function() {
                  return 'Tidak ditemukan hasil';
                }
              });



              // Menambahkan event listener untuk menangani perubahan nilai pada Select2
              $('.namabarang').on('change', function() {
                // Mendapatkan elemen terpilih
                var selectedElement = $('.namabarang').find(':selected');

                // Memperbarui warna teks menjadi hitam
                selectedElement.css('color', 'black');

                // Mendapatkan nilai yang dipilih
                var namabarang = $(this).val();

                // Mengirimkan permintaan AJAX ke skrip PHP untuk mendapatkan satuan
                $.ajax({
                  url: 'get_satuan.php', // Adjust the URL based on your server-side script
                  method: 'GET',
                  dataType: 'json',
                  data: {
                    namabarang: namabarang
                  },
                  success: function(response) {
                    // Memperbarui nilai kolom satuan
                    $('.satuan').val(response.satuan);
                  },
                  error: function() {
                    // Handle kesalahan jika permintaan gagal
                    console.log('Gagal mengambil data satuan');
                  }
                });
              });
            });


