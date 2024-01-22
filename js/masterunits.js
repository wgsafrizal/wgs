
        // Gunakan Fetch API untuk mengambil data dari server
        fetch('model/mastersatuan.php')
            .then(response => response.json())
            .then(data => {
                // Manipulasi DOM untuk menambahkan data ke tabel
                const tableBody = document.getElementById('tableBody');

                // Tambahkan data ke tabel
                data.forEach(row => {
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `<td>${row.id}</td><td>${row.satuan}</td>`;
                    tableBody.appendChild(newRow);
                });
            })
            .catch(error => console.error('Error:', error));