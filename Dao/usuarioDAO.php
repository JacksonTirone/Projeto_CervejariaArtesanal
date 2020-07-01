<?php
    
    class UsuarioDAO {
        public function inserir(Usuario $usuario){
            $query = "INSERT INTO usuario(nome, CPF, dataNascimento, email, senha) VALUES (:nome, :CPF, :dataNascimento, :email, :senha)";
            $pdo = PdoFactory::getConexao();
            $executa = $pdo->prepare($query);
            $executa->bindParam(":nome", $usuario->nome);
            $executa->bindParam(":CPF", $usuario->CPF);
            $executa->bindParam(":dataNascimento", $usuario->dataNascimento);
            $executa->bindParam(":email", $usuario->email);
            $executa->bindParam(":senha", $usuario->senha);
            $executa->execute();
            $usuario->idUsuario = $pdo->lastInsertId();
            return $usuario;
        }

        public function buscaPorEmail($email) {
            $query   = "SELECT * FROM usuario WHERE email = :email"; 
            $pdo     = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->bindParam('email', $email);
            $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
            if(empty($result))
                return false;
            else
                return new Usuario($result->idUsuario, $result->nome, $result->CPF, $result->dataNascimento, $result->email, $result->senha,
                $result->endereco_idEndereco);
        }

        
        public function buscaPorId($idUsuario){
            $query = "SELECT * FROM usuario WHERE idUsuario = :idUsuario";
            $pdo = PdoFactory::getConexao();
            $executa = $pdo->prepare($query);
            $executa->bindParam ("idUsuario", $idUsuario);
            $executa->execute();
            $resultado = $executa->fetch(PDO::FETCH_OBJ);
            return new Usuario($resultado->idUsuario, $resultado->nome, $resultado->CPF, $resultado->dataNascimento, $resultado->email, $resultado->senha, $resultado->endereco_idEndereco);
        }

        public function listar(){
            $query = "SELECT * FROM usuario";
            $pdo = PdoFactory::getConexao();
            $executa = $pdo->prepare($query);
            $executa->execute();
            $listaUsuario = array();
            while($row = $executa->fetch(PDO::FETCH_OBJ)){
                $listaUsuario[] = new Usuario($row->idUsuario, $row->nome, $row->CPF, $row->dataNascimento, $row->email, $row->senha, $row->endereco_idEndereco);
            }
            return $listaUsuario;
          }

          public function atualizar(Usuario $usuario) {
			$query = "UPDATE usuario SET nome=:nome, CPF=:CPF, dataNascimento=:dataNascimento, email=:email, senha=:senha WHERE idUsuario=:idUsuario";            
			$pdo = pdoFactory::getConexao();
			$executa = $pdo->prepare($query);
            $executa->bindParam(":nome", $usuario->nome);
            $executa->bindParam(":CPF", $usuario->CPF);
            $executa->bindParam(":dataNascimento", $usuario->dataNascimento);
            $executa->bindParam(":email", $usuario->email);
            $executa->bindParam(":senha", $usuario->senha);
            $executa->bindParam(":idUsuario", $usuario->idUsuario);
            $executa->execute();
            return $usuario; 
		}

          public function deletar($idUsuario) {
            $query = "DELETE FROM usuario WHERE idUsuario =:idUsuario";            
            $pdo = pdoFactory::getConexao();
            $executa = $pdo->prepare($query);
            $executa->bindParam(":idUsuario", $idUsuario);
            $executa->execute();
            return $idUsuario;
          }
    }


?>