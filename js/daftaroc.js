  var modal = document.getElementById('myModal');

    // Ketika pengguna mengklik di luar modul, tutup modulnya
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };

    // Tombol close di dalam modul untuk menutup modul saat diklik
    var closeButton = document.querySelector('.close');
    closeButton.addEventListener('click', function() {
        modal.style.display = 'none';
    });


    document.addEventListener("DOMContentLoaded", function() {
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];
        var infoButtons = document.querySelectorAll('.infoButton'); // Mengganti editButtons menjadi infoButtons

        span.onclick = function() {
            modal.style.display = "none";
        };

        // Deklarasikan variabel infoButtons
        var infoButtons;

        infoButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var oc = this.dataset.oc;

                // Kirim permintaan AJAX ke PHP untuk mengambil data barang
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var data = JSON.parse(xhr.responseText);
                            showDetails(data.barang); // Ubah sesuai struktur JSON yang diterima
                        } else {
                            alert("Gagal mengambil data dari server.");
                        }
                    }
                };

                xhr.open('GET', 'get_barangoc.php?oc=' + encodeURIComponent(oc), true);
                xhr.send();
            });
        });

        function showDetails(barang) {
            // Bersihkan isi tabel sebelum menambahkan data baru
            document.getElementById("barangTableBody").innerHTML = "";

            // Tambahkan data barang ke dalam tabel
            barang.forEach(function(item) {
                var row = document.createElement("tr");
                row.innerHTML = "<td>" + item.namabarang + "</td>  <td>" + item.qty + "</td>  <td>" + item.satuan + "</td> <td>" + item.price + "</td> <td>" + item.totalprice + "</td>";
                document.getElementById("barangTableBody").appendChild(row);
            });

            // Set nilai quotesDisplay dan salesDisplay


            document.getElementById("ocDisplay").textContent = barang[0].oc; // Ubah sesuai struktur JSON yang diterima
            document.getElementById("quotesDisplay").textContent = barang[0].quotes; // Ubah sesuai struktur JSON yang diterima
            document.getElementById("salesDisplay").textContent = barang[0].sales; // Ubah sesuai struktur JSON yang diterima
            document.getElementById("subtotalDisplay").textContent = barang[0].subtotal; // Ubah sesuai struktur JSON yang diterima
            document.getElementById("tglocDisplay").textContent = barang[0].tgloc; // Ubah sesuai struktur JSON yang diterima
            document.getElementById("ppnDisplay").textContent = barang[0].ppn; // Ubah sesuai struktur JSON yang diterima
            document.getElementById("totalallDisplay").textContent = barang[0].totalall; // Ubah sesuai struktur JSON yang diterima


            modal.style.display = "block";
        }
    });


function updateStatusOC(oc)

 {
    // Prompt the user for confirmation
    var yoyo = confirm('Apakah Anda yakin ingin menyetujui OC?');

    if (yoyo) {
        // Mengirim permintaan AJAX ke server
        $.ajax({
            url: 'update_statusoc.php',
            type: 'POST',
            data: {
                oc: oc
            },
            success: function(response) {
                console.log(response);

                // Tambahkan logika jika perlu
                if (response === 'Success') {
                    alert('OC berhasil di APPROVED');
                    window.location.href = 'daftaroc';
                } else {
                    alert('Gagal mengupdate status QUOTES');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Terjadi kesalahan saat mengirim permintaan AJAX.');
            }
        });
    }
}

