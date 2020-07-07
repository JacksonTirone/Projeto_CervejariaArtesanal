<?php
    class Endereco {
        public $idEndereco;
        public $rua;
        public $bairro;
        public $numero;
        public $complemento;
        public $CEP;
        public $cidade;
        public $pais;
        public $usuario_idUsuario;
    

    function __construct($idEndereco, $rua, $bairro, $numero, $complemento, $CEP, $cidade, $pais, $usuario_idUsuario=""){
        $this->idEndereco = $idEndereco;
        $this->rua = $rua;
        $this->bairro = $bairro;
        $this->numero = $numero;
        $this->complemento = $complemento;
        $this->CEP = $CEP;
        $this->cidade = $cidade;
        $this->pais = $pais;
        $this->usuario_idUsuario = $usuario_idUsuario;
    }
}


?>