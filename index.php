<?php

    // inclui o cabeçalho com requires e configs
    require_once "header.php";

          
    // passar a variável $config como parâmetro da instância do Slim
    $app = new \Slim\App($config);

    $app->group("/api/produto", function(){
            $this->post("","produtoController:inserir");
            $this->get("/{idProduto:[0-9]+}","produtoController:buscaPorId");
            $this->get("","produtoController:listar");
            $this->put("/{idProduto:[0-9]+}","ProdutoController:atualizar");
			$this->delete("/{idProduto:[0-9]+}","ProdutoController:deletar");
        }
    
    );

    $app->group("/api/usuario", function(){
            $this->post("","usuarioController:inserir");
            $this->get("/{idUsuario:[0-9]+}","usuarioController:buscaPorId");
            $this->get("","usuarioController:listar");
            $this->put("/{idUsuario:[0-9]+}","usuarioController:atualizar");
			$this->delete("/{idUsuario:[0-9]+}","usuarioController:deletar");
        }
    
    );

    $app->run();

    
?>