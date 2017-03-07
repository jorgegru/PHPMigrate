<?php



/**
* 
*/
class PHPMigrate
{
	
	private static $db;

	public function __construct($settings){


		$driver = $settings['driver'];
		$host = $settings['host'];
		$database = $settings['database'];
		$username = $settings['username'];
		$password = $settings['password'];
		$charset = $settings['charset'];

		//SQL
		if($driver=='sqlite'){
			$dns = '';
		}else{
			$dns = $driver.":host=".$host.";dbname=".$database.";charset=".$charset;
		}

		try {
            if (!isset(self::$db)) {
                self::$db = new \PDO($dns, $username, $password);
                self::$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }
          
            // return self::$conexao -> prepare($query);
        } catch(\PDOException $e) {
            throw new Exception($e->getMessage());
        } 
	}

	public function init()
	{
		$sql_migration = "CREATE TABLE IF NOT EXISTS `migrations` (
							  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							  `batch` int(11) NOT NULL,
							  `data_table` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
		$sqq = self::$db-> prepare($sql_migration);
		$sqq -> execute();
	}

	public function migrate($pasta){
		if(is_dir($pasta)){

			$diretorio = dir($pasta);
				
			while($arquivo[] = $diretorio->read());	
			array_pop($arquivo);
			
			//Organiza os nome do arquivos
			asort($arquivo);
			array_shift($arquivo); // removendo o  "."
			array_shift($arquivo); // removendo o  ".."
			
			/*
				O indice esta começando no dois pra eliminar as pasta  "." e ".." ;
			*/
			for($i=0, $qt_array=count($arquivo); $i<$qt_array; $i++){	
				
				$ob_arquivo = Array();
				$ob_arquivo = file($pasta.$arquivo[$i]);  
				//Pega Cada Linha e Joga na Matriz$arquivo
				
				if($this->verificaMigrationDb($arquivo[$i])){
					
					try{
						$sql = ""; 
						// Cria a Variavel $sql
						foreach($ob_arquivo as $v) $sql.=$v;

						$sttm = self::$db-> prepare($sql);
						$sttm -> execute();

						$sql = "INSERT INTO migrations (migration, batch, data_table) VALUES ('".$arquivo[$i]."', 1, '". date("Y-m-d H:i:s")."')";
						$sttm = self::$db-> prepare($sql);
						$sttm -> execute();


						echo "\n".$arquivo[$i]."\n";
					    // return self::$conexao -> prepare($query);
			        } catch(\PDOException $e) {
			            exit("\nError: Arquivo ".$arquivo[$i]." \n\n Code: ".$e->getCode()." -> ".$e->getMessage() ."\n\n");
			        } 
				}
			}
		}else{
			echo "\n\ninforme a pasta\n\n";
		}
	}

	private function verificaMigrationDb($arquivo){
		
		$sql = "SELECT * FROM migrations WHERE migration = '".$arquivo."'";
		$sttm = self::$db->prepare($sql);
		$sttm->execute();
		//$result = $sttm -> fetchAll(PDO::FETCH_ASSOC);
		$teste = $sttm->rowCount();
		
		// Caso já exista a importaçao da migration, retornar true
		if(!$teste){
			return true;
		}else{
			return false;
		}
	}


	public function create($pasta, $name){

		if (is_dir($pasta)){   
			$fp = fopen($pasta.date("Y-m-d-His")."-".$name.".sql", "w");
			 
			if($fp){
				echo "\n\nMigration ". date("Y-m-d-His")."-".$name.".sql" . "criada com sucesso\n\n";
			}else{
				echo "\n\nErro ao criar a migration, por favor verifica a permisssão de escrita da pasta :: ".$pasta."\n\n";
			}

			// Fecha o arquivo
			fclose($fp); //-> OK

		} else{
            exit("\n\n Por favor configura uma pasta com permisão de escrita para as migrations \n\n");
        }
	}
}

