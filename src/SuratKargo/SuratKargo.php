<?php

    namespace Hasokeyk\SuratKargo;

    use Exception;
    use SoapFault;

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

            $this->query();
        }

        function query(){
            $url         = $this->liveRequest;
            $this->query = new \SoapClient($url, ['trace' => 1]);
        }

        function createCargo($data = []){

            $defaults = [
                'KisiKurum'                => '',
                'SahisBirim'               => '',
                'AliciAdresi'              => '',
                'Il'                       => '',
                'Ilce'                     => '',
                'TelefonEv'                => '',
                'TelefonIs'                => '',
                'TelefonCep'               => '',
                'Email'                    => '',
                'AliciKodu'                => '',
                'KargoTuru'                => 3,
                'Odemetipi'                => 1,
                'IrsaliyeSeriNo'           => '',
                'IrsaliyeSiraNo'           => '',
                'ReferansNo'               => '',
                'OzelKargoTakipNo'         => '',
                'Adet'                     => 1,
                'BirimDesi'                => 0,
                'BirimKg'                  => 0,
                'KargoIcerigi'             => '',
                'KapidanOdemeTahsilatTipi' => 0,
                'KapidanOdemeTutari'       => 0,
                'EkHizmetler'              => 0,
                'SevkAdresiAdi'            => '',
                'TeslimSekli'              => 1,
                'TasimaSekli'              => 1,
                'BayiNo'                   => '',
            ];

            $data = array_merge($defaults, $data);

            $cargoData = [
                'KullaniciAdi' => $this->username,
                'Sifre'        => $this->password,
                'Gonderi'      => $data,
            ];

            print_r($cargoData);

            try{
                $r = $this->query->GonderiyiKargoyaGonder($cargoData);
                $this->query->__getLastRequest();
                return $r;
            }catch(Exception $e){
                print_r($this->query->__getLastRequest());
                print_r('Gönderi Hatası : '.$e->getMessage());
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