<?php
// include para criação de conexão com banco de dados
require_once "DB/PdoFactory.php";

// includes de classes
require_once "class/produto.php";
require_once "class/usuario.php";



// includes de DAO
require_once "Dao/produtoDAO.php";
require_once "Dao/usuarioDAO.php";


// includes de controllers
require_once "Controller/produtoController.php";
require_once "controller/usuarioController.php";


// include de autoload do Slim
require "vendor/autoload.php";

// configuração do Slim para exibição dos detalhes na ocorrência de erros
$config = [
	'settings'             => [
		'displayErrorDetails' => true,
		'addContentLengthHeader' => false
	],
];
?>