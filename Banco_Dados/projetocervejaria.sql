-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Out-2019 às 16:47
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Banco de dados: `bd_cervejaria`

-- Estrutura da tabela `endereco`

CREATE TABLE `endereco` (
  `idEndereco` int(11) NOT NULL,
  `rua` varchar(150) DEFAULT NULL,
  `bairro` varchar(60) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `complemento` varchar(45) DEFAULT NULL,
  `CEP` varchar(15) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `pais` varchar(45) DEFAULT NULL,
  `usuario_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Estrutura da tabela `marca`

CREATE TABLE `marca` (
  `idMarca` int(11) NOT NULL,
  `nomeFantasia` varchar(60) DEFAULT NULL,
  `informacaoGeral` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Estrutura da tabela `produto`

CREATE TABLE `produto` (
  `idProduto` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(60) DEFAULT NULL,
  `unidadeDePeso` varchar(20) DEFAULT NULL,
  `preco` varchar(45) DEFAULT NULL,
  `tipoCerveja` varchar(60) DEFAULT NULL,
  `porcentagemAlcoolica` varchar(45) DEFAULT NULL,
  `marca_idMarca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Estrutura da tabela `usuario`

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nome` varchar(120) DEFAULT NULL,
  `CPF` varchar(15) DEFAULT NULL,
  `dataNascimento` varchar(10) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `senha` varchar(60) DEFAULT NULL,
  `endereco_idEndereco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Estrutura da tabela `venda`

CREATE TABLE `venda` (
  `idVenda` int(11) NOT NULL,
  `data` datetime DEFAULT NULL,
  `usuario_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Estrutura da tabela `vendaproduto`

CREATE TABLE `vendaproduto` (
  `idVendaProduto` int(11) NOT NULL,
  `venda_idVenda` int(11) NOT NULL,
  `produto_idProduto` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Índices para tabelas despejadas

-- Índices para tabela `endereco`

ALTER TABLE `endereco`
  ADD PRIMARY KEY (`idEndereco`),
  ADD KEY `fk_endereco_usuario1_idx` (`usuario_idUsuario`);


-- Índices para tabela `marca`

ALTER TABLE `marca`
  ADD PRIMARY KEY (`idMarca`);


-- Índices para tabela `produto`

ALTER TABLE `produto`
  ADD PRIMARY KEY (`idProduto`),
  ADD KEY `fk_produto_marca1_idx` (`marca_idMarca`);

-- Índices para tabela `usuario`

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

-- AUTO_INCREMENT de tabelas despejadas

-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `idEndereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


-- AUTO_INCREMENT de tabela `marca`

ALTER TABLE `marca`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


-- AUTO_INCREMENT de tabela `usuario`

ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


-- Restrições para despejos de tabelas

-- Limitadores para a tabela `endereco`

ALTER TABLE `endereco`
  ADD CONSTRAINT `fk_endereco_usuario1` FOREIGN KEY (`usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- Limitadores para a tabela `produto`

ALTER TABLE `produto`
  ADD CONSTRAINT `fk_produto_marca1` FOREIGN KEY (`marca_idMarca`) REFERENCES `marca` (`idMarca`) ON DELETE NO ACTION ON UPDATE NO ACTION;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
