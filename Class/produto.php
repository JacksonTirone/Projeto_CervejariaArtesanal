<?php
    class Produto {
        public $idProduto;
        public $nome;
        public $descricao;
        public $unidadeDePeso;
        public $preco;
        public $tipoCerveja;
        public $porcentagemAlcoolica;
        public $marca_idMarca;

    

    function __construct($idProduto, $nome, $descricao, $unidadeDePeso, $preco, $tipoCerveja, $porcentagemAlcoolica, $marca_idMarca){
        $this->idProduto = $idProduto;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->unidadeDePeso = $unidadeDePeso;
        $this->preco = $preco;
        $this->tipoCerveja = $tipoCerveja;
        $this->porcentagemAlcoolica = $porcentagemAlcoolica;
        $this->marca_idMarca = $marca_idMarca;
        
    }
}

?>