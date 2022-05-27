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
        'cargoKey'         => 'HSN-0000001',
        'invoiceKey'       => 'TEST-0000001',
        'receiverCustName' => 'Hasan Yüksektepe',
        'receiverAddress'  => 'Test Adres',
        'receiverPhone1'   => '05414233558',
    ]);
    print_r($kargoYolla);
    //CREATE CARGO