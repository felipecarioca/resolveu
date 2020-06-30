<?php
    
    include_once 'Orcamento.php';

    class Solicitacao {
            
        public $id;
        public $orcamento;
        public $id_prestador;

        function __construct($id,$orcamento,$id_prestador){
            $this->id = $id;
            $this->orcamento = $orcamento;
            $this->id_prestador = $id_prestador;
        }
    }

?>