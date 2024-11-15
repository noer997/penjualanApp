<!DOCTYPE html>
<html>
<head>
    <title>Data Penjualan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Data Penjualan</h1>
    <button id="createNew">Tambah Data</button>
    <div id="dataList"></div>

    <script>
        $(document).ready(function () {
            function fetchData() {
                $.get('/penjualan', function (data) {
                    let html = '<ul>';
                    data.forEach(item => {
                        html += `<li>${item.nama_barang} - ${item.jumlah} pcs - $${item.harga} 
                                 <button onclick="showData(${item.id})">Edit</button>
                                 <button onclick="deleteData(${item.id})">Delete</button></li>`;
                    });
                    html += '</ul>';
                    $('#dataList').html(html);
                });
            }

            fetchData();

            // CSRF Token setup for AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#createNew').click(function () {
                let newItem = {
                    nama_barang: prompt("Nama Barang"),
                    jumlah: prompt("Jumlah"),
                    harga: prompt("Harga"),
                    tanggal_penjualan: prompt("Tanggal (YYYY-MM-DD)")
                };
                $.post('/penjualan', newItem, function () {
                    alert('Data berhasil ditambahkan');
                    fetchData();
                });
            });

            window.showData = function (id) {
                $.get(`/penjualan/${id}`, function (data) {
                    let updatedItem = {
                        nama_barang: prompt("Nama Barang", data.nama_barang),
                        jumlah: prompt("Jumlah", data.jumlah),
                        harga: prompt("Harga", data.harga),
                        tanggal_penjualan: prompt("Tanggal (YYYY-MM-DD)", data.tanggal_penjualan)
                    };
                    $.ajax({
                        url: `/penjualan/${id}`,
                        type: 'PUT',
                        data: updatedItem,
                        success: function () {
                            alert('Data berhasil diperbarui');
                            fetchData();
                        }
                    });
                });
            };

            window.deleteData = function (id) {
                if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                    $.ajax({
                        url: `/penjualan/${id}`,
                        type: 'DELETE',
                        success: function () {
                            alert('Data berhasil dihapus');
                            fetchData();
                        }
                    });
                }
            };
        });
    </script>
</body>
</html>
