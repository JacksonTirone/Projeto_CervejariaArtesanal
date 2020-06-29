<?php
    class Marca {
        public $idMarca;
        public $nomeFantasia;
        public $descricao;
       


    function __construct($idMarca, $nomeFantasia, $descricao){
        $this->idMarca = $idMarca;
        $this->nomeFantasia = $nomeFantasia;
        $this->descricao = $descricao;
        
    }
}


?>