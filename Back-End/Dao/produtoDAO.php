<?php

    class ProdutoDAO{

        public function inserir(Produto $produto){
            $query = "INSERT INTO produto(nome, descricao, unidadeDePeso, preco, tipoCerveja, porcentagemAlcoolica, marca_idMarca) 
                      VALUES (:nome, :descricao, :unidadeDePeso, :preco, :tipoCerveja, :porcentagemAlcoolica, :marca_idMarca)";
            $pdo = PdoFactory::getConexao();
            $executa = $pdo->prepare($query);
            $executa->bindParam(":nome", $produto->nome);
            $executa->bindParam(":descricao", $produto->descricao);
            $executa->bindParam(":unidadeDePeso", $produto->unidadeDePeso);
            $executa->bindParam(":preco", $produto->preco);
            $executa->bindParam(":tipoCerveja", $produto->tipoCerveja);
            $executa->bindParam(":porcentagemAlcoolica", $produto->porcentagemAlcoolica);
            $executa->bindParam(":marca_idMarca", $produto->marca_idMarca);
            $executa->execute();
            $produto->idProduto = $pdo->lastInsertId();
            return $produto;
        }

        public function buscaPorId($idProduto){
            $query = "SELECT * FROM produto INNER JOIN marca ON produto.marca_idMarca = marca.idMarca WHERE produto.idProduto = :idProduto";
            $pdo = PdoFactory::getConexao();
            $executa = $pdo->prepare($query);
            $executa->bindParam (":idProduto", $idProduto);
            $executa->execute();
            $resultado = $executa->fetch(PDO::FETCH_OBJ);
            return new Produto($resultado->idProduto, $resultado->nome, $resultado->descricao, $resultado->unidadeDePeso, $resultado->preco, $resultado->tipoCerveja, $resultado->porcentagemAlcoolica, $resultado->marca_idMarca, $resultado->nomeFantasia, $resultado->informacaoGeral);
        }

        public function listar(){
            $query = "SELECT * FROM produto INNER JOIN marca ON produto.marca_idMarca = marca.idMarca WHERE produto.idProduto ORDER BY idProduto";
            $pdo = PdoFactory::getConexao();
            $executa = $pdo->prepare($query);
            $executa->execute();
            $listaProduto = array();
            while($row = $executa->fetch(PDO::FETCH_OBJ)){
                $listaProduto[] = new Produto ($row->idProduto, $row->nome, $row->descricao, $row->unidadeDePeso, $row->preco, $row->tipoCerveja, $row->porcentagemAlcoolica, $row->marca_idMarca, $row->nomeFantasia, $row->informacaoGeral);
            }
            return $listaProduto;
          }

          public function atualizar(Produto $produto) {
			$query = "UPDATE produto SET nome=:nome, descricao=:descricao, unidadeDePeso=:unidadeDePeso, preco=:preco, tipoCerveja=:tipoCerveja, porcentagemAlcoolica=:porcentagemAlcoolica  WHERE idProduto=:idProduto";            
			$pdo = pdoFactory::getConexao();
			$executa = $pdo->prepare($query);
            $executa->bindParam(":nome", $produto->nome);
            $executa->bindParam(":descricao", $produto->descricao);
            $executa->bindParam(":unidadeDePeso", $produto->unidadeDePeso);
            $executa->bindParam(":preco", $produto->preco);
            $executa->bindParam(":tipoCerveja", $produto->tipoCerveja);
            $executa->bindParam(":porcentagemAlcoolica", $produto->porcentagemAlcoolica);
            $executa->bindParam(":idProduto", $produto->idProduto);
            $executa->execute();
            return $this->buscaPorId($produto->idProduto); 
		}

          public function deletar($idProduto) {
            $query = "DELETE FROM produto WHERE idProduto =:idProduto";            
            $pdo = pdoFactory::getConexao();
            $executa = $pdo->prepare($query);
            $executa->bindParam(":idProduto", $idProduto);
            $executa->execute();
            return $idProduto;
          }
    }

?>