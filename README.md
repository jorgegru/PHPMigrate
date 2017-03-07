# PHPMigrate

[![Build Status](https://travis-ci.org/jorgegru/PHPMigrate.svg?branch=master)](https://travis-ci.org/jorgegru/PHPMigrate)


PHPMigrate é uma biblioteca escrita em PHP para facilitar o controle de criação de tabela e alteração. Nele podemos registrar nossas migration em apenas um lugar e automatizar o processo de atualização de banco de dados

### Instalação

PHPMigrate requer PHP >= 5.5.

Para instalar o PHPMigrate via composer

```sh
$ composer require jorgegru/migrate
```

É necessario realizar a copia para a raiz do projeto para configuração


```sh
$ cp vendor/jorgegru/migrate/PHPMigrateConf.exemplo.php PHPMigrateConf.php
```

Criar a pasta migrations com a permissão de escrita na raiz do projeto

```sh
$ mkdir migrations
$ chmod 777 -R migrations
```

### Comandos

```sh
## Criar a tabela migrations
$ php vendor/jorgegru/migrate/start init

## Cria o arquivo na pasta migrations
## exemplo NOME_ARQUIVO = create-table-clients / alter-table-clients
$ php vendor/jorgegru/migrate/start create NOME_ARQUIVO
```

```sql
## Exemplo de arquivo
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `sobrenome` varchar(60) NOT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `endereco` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
```

```sh
## Para rodar todas as migrate
$ php vendor/jorgegru/migrate/start migrate
```
