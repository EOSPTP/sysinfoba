<?php
mysql_connect('localhost','root','');
mysql_select_db('koreksi_ptp');
$searchTerm = $_GET['term']; // Menerima kiriman data dari inputan pengguna

$sql="SELECT * FROM mst_customer WHERE NAMA_CUSTOMER LIKE '%".$searchTerm."%' ORDER BY NAMA_CUSTOMER ASC limit 20"; // query sql untuk menampilkan data mahasiswa dengan operator LIKE

$hasil=mysql_query($sql); //Query dieksekusi

//Disajikan dengan menggunakan perulangan
while ($row = mysql_fetch_array($hasil)) {
    $data[] = $row['NAMA_CUSTOMER'];
}
//Nilainya disimpan dalam bentuk json
echo json_encode($data);
?>