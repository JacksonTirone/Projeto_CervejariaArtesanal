<?php
    class Usuario {
        public $idUsuario;
        public $nome;
        public $CPF;
        public $dataNascimento;
        public $email;
        public $senha;

    function __construct($idUsuario, $nome, $CPF, $dataNascimento, $email, $senha){
        $this->idUsuario = $idUsuario;
        $this->nome = $nome;
        $this->CPF = $CPF;
        $this->dataNascimento = $dataNascimento;
        $this->email = $email;
        $this->senha = $senha;
    }
}



?>