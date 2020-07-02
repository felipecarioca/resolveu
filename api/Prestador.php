<?php
    class Prestador {

        public $id;
        public $nome;
        public $cpf;
        public $email;
        public $senha;
        public $cep;
        public $fone;
        public $id_tipo_servico;
        public $endereco;
        public $empresa;
        public $recomendacoes;
                
        function __construct($id, $nome, $cpf, $email,$cep,$fone,$senha,$id_tipo_servico,$endereco,$empresa,$recomendacoes){
            
            $this->id = $id;
            $this->nome = $nome;
            $this->cpf = $cpf;
            $this->email = $email;
            $this->senha = $senha;
            $this->cep = $cep;
            $this->fone = $fone;
            $this->id_tipo_servico = $id_tipo_servico;
            $this->endereco = $endereco;
            $this->empresa = $empresa;
            $this->recomendacoes = $recomendacoes;
           
        }
    }
?>