
                 function showHistory(kodebarang) {
                    // Mengirim permintaan Ajax ke server untuk mendapatkan tgl_in dan tgl_out
                    $.ajax({
                      type: "POST",
                      url: "get_History.php", // Ganti dengan nama file PHP yang akan menghandle permintaan ini
                      data: {
                        kodebarang: kodebarang
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


                            function checksn() {
                              var snSelect = document.getElementById("sn");
                              var serialNumberInput = document.getElementById("serialnumber");
                              var stockInInput = document.getElementById("stock_in");

                              // Periksa nilai dari SN
                              console.log("Nilai SN:", snSelect.value.trim().toUpperCase());

                              if (snSelect.value.trim().toUpperCase() === "YES") {
                                // Jika SN adalah "YES," nonaktifkan readonly pada input nomor seri
                                serialNumberInput.readOnly = false;
                                // Bersihkan nilai jika ada
                                serialNumberInput.value = "";

                                // Set nilai stock_in menjadi 1 dan nonaktifkan inputnya
                                stockInInput.value = 1;
                                stockInInput.disabled = true;
                              } else {
                                // Jika SN bukan "YES," aktifkan readonly pada input nomor seri dan atur nilai default menjadi null
                                serialNumberInput.readOnly = true;
                                serialNumberInput.value = "";

                                // Aktifkan kembali input stock_in dan atur nilai default menjadi null
                                stockInInput.disabled = false;
                                stockInInput.value = null;
                              }
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

            function saveChangesmasuk() {
              // Retrieve data from the form
              var tgl_in = $("#tgl_in").val();
              var namabarang = $(".namabarang").val();
              var satuan = $("#satuan").val();
              var stock_in = $(".qty").val();
              var serialnumber = $("#serialnumber").val();
              var remarks = $("#remarks").val();
              var kodebarang = $("#kodebarang").val();
              var sn = $("#sn").val();



              if (!remarks) {
                alert("Lengkapi Remarks");
                return;
              }


              if (!stock_in) {
                alert("Lengkapi Qty");
                return;
              }




              // Check if any of the required fields is empty
              if (!tgl_in || !namabarang || !satuan || !stock_in || !kodebarang || !sn) {
                // Handle the case where one or more fields are empty
                alert("Lengkapi semua data sebelum menyimpan");
                return;
              }

              // Check if sn is "no" and serialnumber is empty
              if (sn.trim().toLowerCase() === "no" && !serialnumber) {
                // Allow serialnumber to be empty in this case]
              } else if (!serialnumber) {
                // If serialnumber is empty and sn is not "no", show an error
                alert("Lengkapi Serial Number");
                return;
              }












              // Prepare data to be sent to the server
              var data = {
                tgl_in: tgl_in,
                namabarang: namabarang,
                satuan: satuan,
                stock_in: stock_in,
                serialnumber: serialnumber,
                remarks: remarks,
                kodebarang: kodebarang,
                sn: sn
              };


              // Make an AJAX request to save the data to the server
              $.ajax({
                type: "POST", // Change the HTTP method if needed
                url: "save_changes.php", // Replace with the actual server-side script to handle the data
                data: data,
                success: function(response) {
                  // Tanggapi dari server setelah pembaruan berhasil
                  console.log(response);

                  // Sembunyikan modal setelah pembaruan berhasil
                  $("#exampleModalScrollable").modal("hide");


                  // Show an alert after successful save
                  alert("Data berhasil disimpan!");

                  // Refresh halaman atau perbarui tampilan data di tempat jika diperlukan
                  location.reload(); // Anda mungkin ingin menggantinya dengan logika yang lebih tepat
                },



                error: function(error) {
                  // Handle errors, if any
                  console.error(error);
                }
              });
            }



            $(document).ready(function() {
              // Inisialisasi Select2
              $('.namabarang').select2({
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
          