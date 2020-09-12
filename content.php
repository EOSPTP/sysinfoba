<?php
include "config/fungsi_rupiah.php";
include "config/koneksi.php";

$hal = $_GET[hal];
if ($_GET[hal]=='home') {
	include "home.php";
}
elseif ($_GET[hal]=='data_customer') {
	include "customer.php";
}
elseif ($_GET[hal]=='edit_customer') {
	include "edit_customer.php";
}
elseif ($_GET[hal]=='cari_customer') {
	include "cari_customer.php";
}	
elseif ($_GET[hal]=='data_aplikasi') {
	include "aplikasi.php";
}
elseif ($_GET[hal]=='data_terminal') {
	include "terminal.php";
}
elseif ($_GET[hal]=='modul') {
	include "modul.php";
}
elseif ($_GET[hal]=='tambahcustomer') {
	include "tambahcustomer.php";
}
elseif ($_GET[hal]=='ba') {
	include "koreksi_nota.php";
}
elseif ($_GET[hal]=='tambahba') {
	include "tambah-berita-acara.php";
}
elseif ($_GET[hal]=='form_detail_ba') {
	include "detail_koreksi_nota.php";
}
elseif ($_GET[hal]=='tambahmodul') {
	include "tambahmodul.php";
}
elseif ($_GET[hal]=='editmodul') {
	include "editmodul.php";
}
elseif ($_GET[hal]=='tambahaplikasi') {
	include "tambahaplikasi.php";
}
elseif ($_GET[hal]=='editaplikasi') {
	include "edit_aplikasi.php";
}
elseif ($_GET[hal]=='tambahterminal') {
	include "tambahterminal.php";
}
elseif ($_GET[hal]=='editterminal') {
	include "edit_terminal.php";
}
elseif ($_GET[hal]=='detail_berita_acara') {
	include "detail_koreksi_ba.php";
}
elseif ($_GET[hal]=='edit-berita-acara') {
	include "edit-berita-acara.php";
}
elseif ($_GET[hal]=='tambahnota') {
	include "tambahnota.php";
}
elseif ($_GET[hal]=='cari_ba') {
	include "cari_ba.php";
}
elseif ($_GET[hal]=='user') {
	include "user.php";
}
elseif ($_GET[hal]=='tambahuser') {
	include "tambahuser.php";
}
elseif ($_GET[hal]=='edituser') {
	include "edituser.php";
}
elseif ($_GET[hal]=='tambahkoreksi') {
	include "tambah_koreksi.php";
}
elseif ($_GET[hal]=='tambah_ba') {
	include "tambah_berita_acaara.php";
}
elseif ($_GET[hal]=='tambah_kesalahan') {
	include "form_kesalahan.php";
}
elseif ($_GET[hal]=='jejakba') {
	include "jejak_ba.php";
}
elseif ($_GET[hal]=='jejakba2') {
	include "jejak_ba_2.php";
}
elseif ($_GET[hal]=='approve') {
	include "approve_ba.php";
}
elseif ($_GET[hal]=='approve001') {
	include "approve001.php";
}
elseif ($_GET[hal]=='reject001') {
	include "reject001.php";
}
elseif ($_GET[hal]=='detail_berita_acara2') {
	include "detail_koreksi_ba2.php";
}
elseif ($_GET[hal]=='reject222') {
	include "reject222.php";
}
elseif ($_GET[hal]=='tambah_permohonan') {
	include "tambah_permohonan.php";
}
elseif ($_GET[hal]=='edit_permohonan') {
	include "edit_permohonan.php";
}
elseif ($_GET[hal]=='permohonan') {
	include "data_permohonan.php";
}
elseif ($_GET[hal]=='formba') {
	include "form_ba.php";
}
elseif ($_GET[hal]=='detail_ba') {
	include "detail_prioritas.php";
}
elseif ($_GET[hal]=='prioritas') {
	include "prioritas.php";
}
elseif ($_GET[hal]=='cari_per') {
	include "cari_per.php";
}
elseif ($_GET[hal]=='edit_ba') {
	include "edit_ba.php";
}
elseif ($_GET[hal]=='laporan_periode') {
	include "report_periode.php";
}
elseif ($_GET[hal]=='bax') {
	include "bax.php";
}
elseif ($_GET[hal]=='tambahprio') {
	include "tambahprio.php";
}
elseif ($_GET[hal]=='edit_bax') {
	include "edit_bax.php";
}
elseif ($_GET[hal]=='reject_cs') {
	include "reject_cs.php";
}
?>
