<?php

	use Hasokeyk\SuratKargo\SuratKargo;

	require(__DIR__.'/vendor/autoload.php');

	$username = '1332049267';
	$password = '1A2B3C4D';

	$surat_kargo = new SuratKargo([
		'username' => $username,
		'password' => $password,
	]);

	//CREATE CARGO
	$kargo_no    = time();
	$kargo_yolla = $surat_kargo->createCargo([
		'OzelKargoTakipNo' => $kargo_no,
		'AliciKodu'        => 'Deneme Deneme',
		'KisiKurum'        => 'Deneme Kurum',
	]);

	print_r($kargo_yolla);
	//CREATE CARGO
