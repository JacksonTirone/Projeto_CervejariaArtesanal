<?php
    class ProdutoController{
        
        public function inserir($request, $response, $args){
          $var = $request->getParsedBody();
          $produto = new Produto(0, $var['nome'], $var['descricao'], $var['unidadeDePeso'], $var['preco'], $var['tipoCerveja'], $var['porcentagemAlcoolica'], $var['marca_idMarca']);
          //print_r($produto);
          $dao = new produtoDAO();
          $produto = $dao->inserir($produto);
          $response = $response->withJson($produto);
          $response = $response->withHeader('Content-type', 'application/json');
          $response = $response->withStatus(201);
          return $response;
        }

        public function buscaPorId($request, $response, $args){
          $idProduto = (int) $args['idProduto'];
          $dao = new produtoDAO();
          $produto = $dao->buscaPorId($idProduto);
          $response = $response->withJson($produto);
          $response = $response->withHeader('Content-type', 'application/json');    
          return $response;
        }

        public function listar($request, $response, $args){
          $dao = new produtoDAO();
          $listar = $dao->listar();
          $response = $response->withJson($listar);
          $response = $response->withHeader("Content-type", "application/json");
		      return $response;
        }

        public function atualizar($request, $response, $args){
          $idProduto = (int) $args["idProduto"];
          $var = $request->getParsedBody();
          $produto = new Produto($idProduto, $var['nome'], $var['descricao'], $var['unidadeDePeso'], $var['preco'], $var['tipoCerveja'], $var['porcentagemAlcoolica'], $var['marca_idMarca']);
          $dao = new produtoDAO();
          $dao->atualizar($produto);
          $response = $response->withJson($produto);
          $response = $response->withHeader('Content-type', 'application/json');
          return $response;
        }
  
        public function deletar($request, $response, $args){
        $idProduto = (int) $args["idProduto"];
        $dao = new produtoDAO();
        $produto = $dao->buscaPorId($idProduto);
        $dao->deletar($idProduto);
        $response = $response->withJson($produto);
        $response = $response->withHeader('Content-type', 'application/json');
        return $response;
        }





    }


?>