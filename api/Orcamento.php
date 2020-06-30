<?php
    class Orcamento {
        
        public $id;
        public $descricao;
        public $id_cliente;
        public $cep;
        public $id_tipo_servico;
        
        function __construct($id, $descricao, $id_cliente, $cep, $id_tipo_servico) {
            $this->id = $id;
            $this->descricao = $descricao;
            $this->id_cliente = $id_cliente;
            $this->cep = $cep;
            $this->id_tipo_servico = $id_tipo_servico;
        }
        
    }
?>