# PHPMigrate

[![Build Status](https://travis-ci.org/jorgegru/PHPMigrate.svg?branch=master)](https://travis-ci.org/jorgegru/PHPMigrate)


PHPMigrate é uma biblioteca escrita em PHP para facilitar o controle de criação de tabela e alteração. Nele podemos registrar nossas migration em apenas um lugar e automatizar o processo de atualização de banco de dados

### Installation

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