<?php

    class Solicitacao {
            
        public $id;
        public $id_cliente;
        public $id_orcamento;
        public $id_prestador;
        public $id_tipo_servico;
        public $id_status_servico;   

        function __construct($id,$id_cliente,$id_orcamento,$id_prestador,$id_tipo_servico,$id_status_servico){
            $this->id = $id;
            $this->id_cliente = $id_cliente;
            $this->id_orcamento=$id_orcamento;
            $this->id_prestador=$id_prestador;
            $this->id_tipo_servico=$id_tipo_servico;
            $this->id_status_servico=$id_status_servico;
        }
    }

?>