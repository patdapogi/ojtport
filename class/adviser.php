<?php

class Adviser{

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

			public function AddAdviser($fname,$lname,$dept,$subj){

					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				// $shapass = $password;		
				$sql  	 = "INSERT INTO account_adviser (fname,lname,dept,subj) VALUES(:fname,:lname,:dept,:subj)";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':fname'=>$fname,':lname'=>$lname,':dept'=>$dept,':subj'=>$subj);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}
		

			public function UpdateAdviser($id,$fname,$lname,$dept,$subj){


					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				$sql  	 = "UPDATE account_adviser set fname=:fname, lname=:lname, dept=:dept, subj=:subj where id=:id";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':id'=>$id,':fname'=>$fname,':lname'=>$lname,':dept'=>$dept,':subj'=>$subj);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}
		
			
			public function PasswordMatch($id,$oldpassword){

						if(!$this->OpenDB()){
							error_log("OPEN DB ERROR!");
							return false;
						}

				$shapass = $oldpassword;	
				
				$sql = "Select * from portal_users where id = :id and auth_pass = :shapass";
				
				$q = $this->conn->prepare($sql);

				$value = array(':id'=>$id,':shapass'=>$shapass);
				
				$q->execute($value);

				$count = $q->rowCount();
				

				if($count != 0){
						return true;					

				}else{
					return false;
					
				}


				return false;
			}


			public function PasswordChange($id,$newpassword){


					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				$shapass = $newpassword;		
				$sql  	 = "UPDATE account_adviser set auth_pass=:shapass where id = :id";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':id'=>$id,':shapass'=>$shapass);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}

			public function DeleteAdviser($id){


					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				$sql  	 = "DELETE from account_adviser where id = :id";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':id'=>$id);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

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

			        // $sql = 'SELECT * FROM bapt_tbl';
			        // $rows = $this->conn->query($sql);

			        // return $rows;
		    }


}

$adviser = new Adviser();


?>