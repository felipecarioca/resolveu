<?php
    
    include_once 'Orcamento.php';

    class Solicitacao {
            
        public $id;
        public $orcamento;
        public $id_prestador;
        public $aceita;

        function __construct($id,$orcamento,$id_prestador,$aceita){
            $this->id = $id;
            $this->orcamento = $orcamento;
            $this->id_prestador = $id_prestador;
            $this->aceita = $aceita;
        }
    }

?>