<?php
    class Usuario {
        public $idUsuario;
        public $nome;
        public $CPF;
        public $dataNascimento;
        public $email;
        public $senha;
        public $endereco_idEndereco;

    function __construct($idUsuario, $nome, $CPF, $dataNascimento, $email, $senha, $endereco_idEndereco=""){
        $this->idUsuario = $idUsuario;
        $this->nome = $nome;
        $this->CPF = $CPF;
        $this->dataNascimento = $dataNascimento;
        $this->email = $email;
        $this->senha = $senha;
        $this->endereco_idEndereco = $endereco_idEndereco;
    }
}



?>