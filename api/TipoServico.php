<?php
    class Cliente {
        
        public $id;
        public $nome;
        public $cpf;
        public $email;
        public $senha;
        public $cep;
        public $telefone;
        
                
        function __construct($id,$nome, $cpf, $email, $senha, $cep, $telefone){
            $this->id = $id;
            $this->nome = $nome;
            $this->cpf = $cpf;
            $this->email = $email;
            $this->senha = $senha;
            $this->cep = $cep;
            $this->telefone = $telefone;
        
        }
    }
?>