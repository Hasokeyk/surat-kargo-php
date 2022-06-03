<?php

    use Hasokeyk\SuratKargo\SuratKargo;

    require "vendor/autoload.php";

    $surat_kargo = new SuratKargo([
        'username' => '1322870342',
        'password' => 'Kt.132',
        'dealerNo' => '1322870342',
        'test'     => true
        //TEST MODE true / false
    ]);

    //CREATE CARGO
    $kargoYolla = $surat_kargo->createCargo([
        'OzelKargoTakipNo' => '123456789',
        'AliciKodu'        => '123456789',
        'KisiKurum'        => 'İbrahim Tatlıses',
        'TelefonCep'       => '5330482781',
        'AliciAdresi'      => 'Abdurrahmangazi mh. Keskin Sk. No:27-29 D:2 Sancaktepe/İstanbul',
        'Il'               => 'İstanbul',
        'Ilce'             => 'Sancaktepe',
        'Odemetipi'        => 2,
    ]);
    print_r($kargoYolla);
    //CREATE CARGO