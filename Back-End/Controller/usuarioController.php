<?php

    class UsuarioController{

        public function inserir($request, $response, $args){
          $var = $request->getParsedBody();
          $usuario = new Usuario(0, $var['nome'], $var['CPF'], $var['dataNascimento'], $var['email'], $var['senha']);
          //print_r($usuario);
          $dao = new usuarioDAO();
          $usuario = $dao->inserir($usuario);
          $response = $response->withJson($usuario);
          $response = $response->withHeader('Content-type', 'application/json');
          $response = $response->withStatus(201);
          return $response;
        }

        public function buscaPorId($request, $response, $args){
          $idUsuario = (int) $args['idUsuario'];
          $dao = new usuarioDAO();
          $usuario = $dao->buscaPorId($idUsuario);
          $response = $response->withJson($usuario);
          $response = $response->withHeader('Content-type', 'application/json');    
          return $response;
        }

        public function listar($request, $response, $args){
          $dao = new usuarioDAO();
          $listar = $dao->listar();
          $response = $response->withJson($listar);
          $response = $response->withHeader("Content-type", "application/json");
		      return $response;
        }

        public function atualizar($request, $response, $args){
          $idUsuario = (int) $args["idUsuario"];
          $var = $request->getParsedBody();
          $usuario = new Usuario($idUsuario, $var['nome'], $var['CPF'], $var['dataNascimento'], $var['email'], $var['senha']);
          $dao = new usuarioDAO();
          $dao->atualizar($usuario);
          $response = $response->withJson($usuario);
          $response = $response->withHeader('Content-type', 'application/json');
          return $response;
        }
  
        public function deletar($request, $response, $args){
        $idUsuario = (int) $args["idUsuario"];
        $dao = new usuarioDAO();
        $usuario = $dao->buscaPorId($idUsuario);
        $dao->deletar($idUsuario);
        $response = $response->withJson($usuario);
        $response = $response->withHeader('Content-type', 'application/json');
        return $response;
        }
    }
?>