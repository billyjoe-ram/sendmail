<?php

    class Mensagem {
        private $para = null;
        private $assunto = null;
        private $mensagem = null;
        public $status = ['cd_status' => null, 'ds_status' => ''];

        public function __get($atributo) {
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
        }
    }