<?php

    namespace Hasokeyk\SuratKargo;

    use Exception;

    class SuratKargo{

        public $liveRequest = 'http://www.suratkargo.com.tr/GonderiWebServiceGercek/service.asmx?WSDL';
        public $username;
        public $password;
        public $dealerNo;
        public $lang = 'TR';
        public $query;

        function __construct($data = []){

            if(!class_exists('SoapClient')){
                echo 'SoapClient Not Fount';
                exit;
            }

            $this->username = $data['username'];
            $this->password = $data['password'];
            $this->dealerNo = $data['dealerNo'];

            $this->lang     = $data['lang'] ?? $this->lang;
            $this->testMode = $data['test'] ?? $this->testMode;

            $this->query();
        }

        function query(){
            $url         = $this->liveRequest;
            $this->query = new \SoapClient($url);
        }

        function createCargo($data = []){

            $defaults = [
                'KisiKurum'                => 'Hasan Yüksektepe',
                'SahisBirim'               => '',
                'AliciAdresi'              => '',
                'Il'                       => '',
                'Ilce'                     => '',
                'TelefonCep'               => '',
                'AliciKodu'                => '1',
                'KargoTuru'                => 3,
                'Odemetipi'                => 1,
                'TeslimSekli'              => 2,
                'TasimaSekli'              => 1,
                'IrsaliyeSeriNo'           => '',
                'IrsaliyeSiraNo'           => '',
                'ReferansNo'               => '',
                'OzelKargoTakipNo'         => '',
                'Adet'                     => '1',
                'BirimDesi'                => '',
                'BirimKg'                  => '',
                'KargoIcerigi'             => '',
                'KapidanOdemeTahsilatTipi' => 0,
                'KapidanOdemeTutari'       => 0,
            ];

            $data = array_merge($defaults, $data);

            $cargoData = [
                'KullaniciAdi' => $this->username,
                'Sifre'        => $this->password,
                'Gonderi'      => $data,
            ];

            try{
                return $this->query->GonderiyiKargoyaGonder($cargoData);
            }catch(Exception $e){
                print_r('Hata : '.$e->getMessage());
            }

        }

        function cancelCargo($data = []){

            $cargoData = [
                'wsUserName'   => $this->username,
                'wsPassword'   => $this->password,
                'userLanguage' => $this->lang,
                'cargoKeys'    => $data['cargoKeys'],
            ];

            try{
                return $this->query->cancelShipment($cargoData);
            }catch(Exception $e){
                print_r('Hata : '.$e->getMessage());
            }

        }

        function cargoStatus($data){

            $cargoData = [
                'wsUserName'        => $this->username,
                'wsPassword'        => $this->password,
                'wsLanguage'        => $this->lang,
                'keys'              => $data['cargoKeys'] ?? $data['invoiceKey'],
                'keyType'           => isset($data['cargoKeys']) ? 0 : 1,
                'addHistoricalData' => true,
                'onlyTracking'      => true,
            ];

            try{
                return $this->query->queryShipment($cargoData);
            }catch(Exception $e){
                print_r('Hata : '.$e->getMessage());
            }

        }

    }