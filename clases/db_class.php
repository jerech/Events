<?php	

	class BDConexion {
		var $conx;
		//function conect($host, $usr, $clave, $bd_name) {
		function conect($bd_name = '') {
			//$host = "nativoapps.com";
			$host = "127.0.0.1";
			$usr = "postgres";
			//$usr = "root";
			$port = "5432";
			$clave = "1qaz2wsx";
			//$clave = "root";
			$bd_name = $bd_name;

			try{
   
   		    $this->conx = new PDO("pgsql:host=$host;port=$port;dbname=$bd_name;user=$usr;password=$clave");
    		
    		$this->conx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		
    		if($this->conx){
              //echo "conecto";
    		}

			}catch (PDOException $e){
   			 echo $e->getMessage();
			}

				
		}

		// trans.php
		function begin() {
			$this->conx->beginTransaction();
		 	//@pg_query("BEGIN");
		 }
		
		function close() {
			//@pg_close($this->conx);
			$this->conx=null;
		}
			
		function commit() {
			//$conx->exec("COMMIT");	
			$this->conx->commit();
			return $this->conx->lastInsertId();
		}
			
		function rollback() {
			$this->conx->rollback();
		}

		function lastInsertId() {
			return $this->conx->lastInsertId();
		}
		
		/*
		Funcion encargada de ejecutar un query o sentencia de alteracion sobre la base de datos
		@param $query sentencia a ejecutar
		@return OK en caso de exito; descripcion del error en caso contrario
		*/
		function executeUpdate($query) {

		try{
			$this->conx->beginTransaction();
			// transaction begins
			$querys=split("&",$query);
			for($i=0;$i<count($querys);$i++)
			{
				
				$result = $this->conx->prepare($querys[$i]) or die (print_r($this->conx->errorInfo(), true));
				
	            $result->execute();


			}

			if($result) {

					$this->commit(); // transaction is committed
					return "OK";
					
				} else {
					$this->rollback(); // transaction rolls back
					return $result;
					exit();	
				}
			

	      }catch (PDOException $e){
   			 echo $e->getMessage();
		  }
		  
		}

		function Query($dato)
		{
			return $this->conx->query($dato);
		    	
		}
		
		/*
		Funcion encargada de ejecutar un query o sentencia de consulta sobre la base de datos
		@param $query sentencia a ejecutar
		@return array asociativo con los elementos recuperados de la consulta
		*/
		function executeQuery($dato) {	
			$this->begin();
		    $result = $this->conx->query($dato);
		    $arrResult = array();
			$count = 0;

		    while($row = $result->fetch(PDO::FETCH_ASSOC)){
				$arrResult[$count] = $row;
				//print_r($row);
				$count += 1;
		    }
		    
			return $arrResult;
			
		}
	}



