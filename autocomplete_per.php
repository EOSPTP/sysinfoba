<?php
mysql_connect('localhost','root','');
mysql_select_db('koreksi_ptp');
$searchTerm = $_GET['term']; // Menerima kiriman data dari inputan pengguna

$sql="SELECT * FROM permohonan WHERE NO_SURAT LIKE '%".$searchTerm."%' ORDER BY NO_PERMOHONAN ASC limit 20"; // query sql untuk menampilkan data mahasiswa dengan operator LIKE

$hasil=mysql_query($sql); //Query dieksekusi

//Disajikan dengan menggunakan perulangan
while ($row = mysql_fetch_array($hasil)) {
    $data[] = $row['NO_SURAT'];
}
//Nilainya disimpan dalam bentuk json
echo json_encode($data);
?>