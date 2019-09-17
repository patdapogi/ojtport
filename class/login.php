<?php

class Login{

			public $host="localhost";
			public $user="root";
			public $pass="";
			public $conn;
			
			public function OpenDB(){

				$this->conn = new PDO("mysql:host=".$this->host.";dbname=lpu_ojt_portal",$this->user,$this->pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
				
				if(!$this->conn){
					return false;
				}

				return true;
			
			}

			
			public function LoginAuth($auth_user,$auth_pass){

						if(!$this->OpenDB()){
							error_log("OPEN DB ERROR!");
							return false;
						}
	
				
				$sql = "SELECT * FROM portal_users WHERE auth_user = :auth_user AND auth_pass = :shapass";
				
				$q = $this->conn->prepare($sql);

				$value = array(':auth_user'=>$auth_user,':shapass'=>$auth_pass);
				
				$q->execute($value);

				$count = $q->rowCount();

				if($count != 0){
						return true;					

				}else{
					return false;
					
				}


				return false;
			}
		

			public function GetId($auth_user,$auth_pass){
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}
				
			
				$sql = "SELECT * FROM portal_users WHERE auth_user = :auth_user AND auth_pass = :auth_pass";
				
				$q = $this->conn->prepare($sql);

				$value = array(':auth_user'=>$auth_user,':auth_pass'=>$auth_pass);
				
				$q->execute($value);


				while ($row = $q->fetch(PDO::FETCH_ASSOC)){ 
    			 				
						$data[]=$row;
	 			}

	 			//array
				return $data;
			}

			public function GetData($id){
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}
				
				$sql = "SELECT * FROM portal_users WHERE id = :id";
				$q = $this->conn->prepare($sql);
				$value = array(':id'=>$id);
				$q->execute($value);

				while ($row = $q->fetch(PDO::FETCH_ASSOC)){

						$data[]=$row;
	 			}

	 			//array
				return $data;
			}


			public function NumRow($sqlselect){
				
				try{

				if(!$this->OpenDB()){
					error_log("OPEN DB ERROR!");
					return false;
				}


				$nrow = $this->conn->prepare($sqlselect);
				$nrow ->execute();



				     if(!$nrow->execute()){

				        $errmsg = implode(" ", $nrow->errorInfo());
				        $er = implode(" ", $this->conn->errorInfo());
				        $emsg = "error code  :".$errmsg." || error code  : ".$er;	

				        
				        throw new Exception($emsg);

				        return false;

					}

				$num_rows = $nrow->rowCount();

				return $num_rows;

				}catch(Exception $e){
					$err = "Message: ".$e->getMessage()."\n File: ".$e->getFile()." Line: " . $e->getLine()."\n Trace: ".$e->getTraceAsString(); 
					catcherror_log($err);
				}
			}

			
			public function loadAll($sqlselect)
		    {
					try{

						if(!$this->OpenDB()){
							error_log("OPEN DB ERROR!");
							return false;
						}

					    $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
					    $qselect = $this->conn->prepare($sqlselect);
					    
					    
					    if(!$qselect->execute()){

					            $errmsg = implode(" ", $qselect->errorInfo());
					            $er = implode(" ", $this->conn->errorInfo());
					            $emsg = "error code  :".$errmsg." || error code  : ".$er;	

					            throw new Exception($emsg);
					            return false;

					    }
			            $data = $qselect->fetchAll();
			            return $data;
					    

					}catch(Exception $e){
						$err = "\n Message: ".$e->getMessage()."\n File: ".$e->getFile()." Line: " . $e->getLine()."\n Trace: ".$e->getTraceAsString(); 
						catcherror_log($err);

					}

		    }


}

$login = new Login();


?>