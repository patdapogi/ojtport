<?php

 
 define("MAX_SIZE_ALLOWED", 1048576); //around 1mb


class Listing{

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


			public function AddEvaluation($student_id,$name,$course,$category_id,$category,$remarks){


					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				$sql  	 = "INSERT INTO student_evaluation (student_id,name,course,category_id,category,remarks) VALUES(:student_id,:name,:course,:category_id,:category,:remarks)";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':student_id'=>$student_id,':name'=>$name,':course'=>$course,':category_id'=>$category_id,':category'=>$category,':remarks'=>$remarks);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}

			public function CheckEvaluation($id){

						if(!$this->OpenDB()){
							error_log("OPEN DB ERROR!");
							return false;
						}
				
				$sql = "Select * from student_evaluation where student_id = :id";
				
				$q = $this->conn->prepare($sql);

				$value = array(':id'=>$id);
				
				$q->execute($value);

				$count = $q->rowCount();
				

				if($count != 0){
						return true;					

				}else{
					return false;
					
				}


				return false;
			}
			

			public function AddAnnouncement($title,$details,$event_date,$exp_event_date){


					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				$shapass = sha1($pass);		
				$sql  	 = "INSERT INTO list_announcement (title,details,event_date,exp_event_date) VALUES(:title,:details,:event_date,:exp_event_date)";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':title'=>$title,':details'=>$details,':event_date'=>$event_date,':exp_event_date'=>$exp_event_date);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}
			

			public function AddDepartment($name_type,$name_code){

					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				// $shapass = $password;		
				$sql  	 = "INSERT INTO types_departments (name_type,name_code) VALUES(:name_type,:name_code)";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':name_type'=>$name_type,':name_code'=>$name_code);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}

			public function AddClassSection($class_id,$section){

					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				// $shapass = $password;		
				$sql  	 = "INSERT INTO list_section (class_id,section) VALUES(:class_id,:section)";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':class_id'=>$class_id,':section'=>$section);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}

			public function AddClassList($dept_id,$year,$course,$date_created){

					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				// $shapass = $password;		
				$sql  	 = "INSERT INTO list_class (dept_id,year,course,date_created) VALUES(:dept_id,:year,:course,:date_created)";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':dept_id'=>$dept_id,':year'=>$year,':course'=>$course,':date_created'=>$date_created);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}

			public function UpdateClass($id,$year,$course){


					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				$sql  	 = "UPDATE list_class set year=:year, course=:course where id=:id";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':id'=>$id,':year'=>$year,':course'=>$course);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}


			public function DeleteClass($id){
					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				$sql  	 = "DELETE from list_class where id = :id";
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


			public function saveImage($image){

					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				// $shapass = $password;		
				$sql  	 = "INSERT INTO list_student (image) VALUES(:image)";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':image'=>$image);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}

			public function AddStudentAccount($student_id,$name_first,$name_last,$username,$password,$id_user_type){
					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				// $shapass = sha1($password);		
				$shapass =	$password;		
				$sql  	 = "INSERT INTO portal_users (ss_id,name_first,name_last,auth_user,auth_pass,id_user_type) VALUES(:student_id,:name_first,:name_last,:username,:shapass,:id_user_type)";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':student_id'=>$student_id,':name_first'=>$name_first,':name_last'=>$name_last,':username'=>$username,':shapass'=>$shapass,':id_user_type'=>$id_user_type);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;



			}

			

			public function CheckStudentAccountCredentials($username,$password){

						if(!$this->OpenDB()){
							error_log("OPEN DB ERROR!");
							return false;
						}

				// $shapass = sha1($password);		
				$shapass = $password;		
				
				$sql = "Select * from portal_users where auth_user = :username and auth_pass = :shapass";
				
				$q = $this->conn->prepare($sql);

				$value = array(':username'=>$username,':shapass'=>$shapass);
				
				$q->execute($value);

				$count = $q->rowCount();
				

				if($count != 0){
						return true;					

				}else{
					return false;
					
				}


				return false;
			}

			public function ChangeStudentPassword($student_id,$password_new){


					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				// $shapass = sha1($password_new);	
				$shapass = $password_new;		
				$sql  	 = "UPDATE portal_users set auth_pass=:shapass where ss_id=:student_id";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':student_id'=>$student_id,':shapass'=>$shapass);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}

			public function AddStudent($adviser_id,$fname,$lname,$course,$class_code,$section,$year,$intern_type,$mobile_no,$email_add,$ojt_position,$ojt_dept,$ojt_start_date,$ojt_end_date,$company_id,$company_name,$supervisor_mobile_no,$supervisor_name,$supervisor_position,$supervisor_email_add,$supervisor_dept,$image){


					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				$shapass = sha1($pass);		
				$sql  	 = "INSERT INTO list_student (adviser_id,fname,lname,course,class_code,section,year,intern_type,mobile_no,email_add,ojt_position,ojt_dept,ojt_start_date,ojt_end_date,company_id,company_name,supervisor_mobile_no,supervisor_name,supervisor_position,supervisor_email_add,supervisor_dept,image) VALUES(:adviser_id,:fname,:lname,:course,:class_code,:section,:year,:intern_type,:mobile_no,:email_add,:ojt_position,:ojt_dept,:ojt_start_date,:ojt_end_date,:company_id,:company_name,:supervisor_mobile_no,:supervisor_name,:supervisor_position,:supervisor_email_add,:supervisor_dept,:image)";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':adviser_id'=>$adviser_id,':fname'=>$fname,':lname'=>$lname,':course'=>$course,':class_code'=>$class_code,':section'=>$section,':year'=>$year,':intern_type'=>$intern_type,':mobile_no'=>$mobile_no,':email_add'=>$email_add,':ojt_position'=>$ojt_position,':ojt_dept'=>$ojt_dept,':ojt_start_date'=>$ojt_start_date,':ojt_end_date'=>$ojt_end_date,':company_id'=>$company_id,':company_name'=>$company_name,':supervisor_mobile_no'=>$supervisor_mobile_no,':supervisor_name'=>$supervisor_name,':supervisor_position'=>$supervisor_position,':supervisor_email_add'=>$supervisor_email_add,':supervisor_dept'=>$supervisor_dept,':image'=>$image);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}

			public function EditStudent($id,$fname,$lname,$course,$section,$year,$intern_type,$mobile_no,$email_add,$ojt_position,$ojt_dept,$ojt_start_date,$ojt_end_date,$company_id,$company_name,$supervisor_mobile_no,$supervisor_name,$supervisor_position,$supervisor_email_add,$supervisor_dept){


					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				$shapass = sha1($pass);		
				 
				$sql  	 ="UPDATE list_student set fname=:fname, lname=:lname, course=:course, section=:section, year=:year, intern_type=:intern_type, mobile_no=:mobile_no, email_add=:email_add, ojt_position=:ojt_position, ojt_dept=:ojt_dept, ojt_start_date=:ojt_start_date, ojt_end_date=:ojt_end_date, company_id=:company_id, company_name=:company_name, supervisor_mobile_no=:supervisor_mobile_no, supervisor_name=:supervisor_name, supervisor_position=:supervisor_position, supervisor_email_add=:supervisor_email_add, supervisor_dept=:supervisor_dept where id=:id";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':id'=>$id,':fname'=>$fname,':lname'=>$lname,':course'=>$course,':section'=>$section,':year'=>$year,':intern_type'=>$intern_type,':mobile_no'=>$mobile_no,':email_add'=>$email_add,':ojt_position'=>$ojt_position,':ojt_dept'=>$ojt_dept,':ojt_start_date'=>$ojt_start_date,':ojt_end_date'=>$ojt_end_date,':company_id'=>$company_id,':company_name'=>$company_name,':supervisor_mobile_no'=>$supervisor_mobile_no,':supervisor_name'=>$supervisor_name,':supervisor_position'=>$supervisor_position,':supervisor_email_add'=>$supervisor_email_add,':supervisor_dept'=>$supervisor_dept);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}

			public function UpdateUploadStudentimage($id,$imagecontent){


					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				$sql  	 = "UPDATE list_student set image=:imagecontent where id=:id";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':id'=>$id,':imagecontent'=>$imagecontent);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}


			public function DeleteStudent($id){
					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				$sql  	 = "DELETE from list_student where id = :id";
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


			public function getYearStudent($class_code){
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}
				
				$sql = "Select * from list_class where id = :class_code";
				
				$q = $this->conn->prepare($sql);

				$value = array(':class_code'=>$class_code);
				
				$q->execute($value);


				while ($row = $q->fetch(PDO::FETCH_ASSOC)){ 
    			 				
						$data[]=$row;
	 			}

	 			//array
				return $data;
			}


			public function getCourseStudent($course_code){
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}
				
				$sql = "Select * from types_courses where name_code = :course_code";
				
				$q = $this->conn->prepare($sql);

				$value = array(':course_code'=>$course_code);
				
				$q->execute($value);


				while ($row = $q->fetch(PDO::FETCH_ASSOC)){ 
    			 				
						$data[]=$row;
	 			}

	 			//array
				return $data;
			}


			public function getCompanyAddress($company_id){
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}
				
				$sql = "Select * from list_offers where id = :company_id";
				
				$q = $this->conn->prepare($sql);

				$value = array(':company_id'=>$company_id);
				
				$q->execute($value);


				while ($row = $q->fetch(PDO::FETCH_ASSOC)){ 
    			 				
						$data[]=$row;
	 			}

	 			//array
				return $data;
			}

			public function AddOffers($company_name,$industry,$address,$date_created,$position,$course,$status){

					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				// $shapass = $password;		
				$sql  	 = "INSERT INTO list_offers (company_name,position,industry,address,date_created,course_required,status) VALUES(:company_name,:position,:industry,:address,:date_created,:course,:status)";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':company_name'=>$company_name,':industry'=>$industry,':position'=>$position,':address'=>$address,':date_created'=>$date_created,':course'=>$course,':status'=>$status);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}

			public function UpdateOffers($id,$company_name,$industry,$address,$position,$course){


					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				$sql  	 = "UPDATE list_offers set company_name=:company_name, industry=:industry , address=:address, position=:position,course_required=:course where id=:id";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':id'=>$id,':company_name'=>$company_name,':industry'=>$industry,':address'=>$address,':position'=>$position,':course'=>$course);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}


			public function DeleteOffers($id){
					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				$sql  	 = "DELETE from list_offers where id = :id";
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

			public function getStudentName($student_id){
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}
				
				$sql = "SELECT * FROM portal_users WHERE id = '".$student_id."' AND id_user_type = 1";

				$q = $this->conn->prepare($sql);
					
				$value = array(':id'=>$student_id);

				$q->execute($value);


				while ($row = $q->fetch(PDO::FETCH_ASSOC)){ 

						$data[]=$row;
	 			}

	
				return $data;
			}


			public function myAdviser($id){

				if(!$this->OpenDB()){
					error_log("OPEN DB ERROR!");
					return false;
				}

				$sql = "SELECT * FROM portal_users INNER JOIN portal_students ON portal_users.id = portal_students.id_user";

				$q = $this->conn->prepare($sql);

				$value = array(':id'=>$id);
				
				$q->execute($value);
				
				while ($row = $q->fetch(PDO::FETCH_ASSOC)){ 
    			 				
					$data[]=$row;
			 }

			 //array
			return $data;



			}

			public function getAdviserDetails($id){
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}

				
				$sql = "SELECT * FROM portal_students 
		
				LEFT JOIN portal_users ON portal_students.id_adviser = portal_users.id 
				
				LEFT JOIN types_departments ON types_departments.id = portal_users.dept_id
				
				WHERE portal_students.id_user = $id";
				
				$q = $this->conn->prepare($sql);

				$value = array(':id'=>$id);
				
			 	$q->execute($value);

				while ($row = $q->fetch(PDO::FETCH_ASSOC)){ 
    			 				
						$data[]=$row;
	 			}

				 //array
				// var_dump($data);die;
				return $data;
			}

			public function AddChecklist($student_id,$checklist,$student_name,$code,$date_created){

					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				// $shapass = $password;		
				$sql  	 = "INSERT INTO list_checklist (student_id,student_name,checklist,code,date_created) VALUES(:student_id,:student_name,:checklist,:code,:date_created)";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':student_id'=>$student_id,':student_name'=>$student_name,':checklist'=>$checklist,':code'=>$code,':date_created'=>$date_created);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}


			public function AddStudentChecklist($checklist,$student_id){


					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				$sql  	 = "UPDATE list_student set checklist=:checklist where id=:student_id";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':checklist'=>$checklist,':student_id'=>$student_id);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}

			public function ApproveChecklist($student_id,$code,$checked){


					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				$sql  	 = "UPDATE list_checklist set checked=:checked where student_id=:student_id and code=:code";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':checked'=>$checked,':student_id'=>$student_id,':code'=>$code);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}


			public function UpdateChecklist($list_id,$checked_val,$student_id){


					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				$sql  	 = "UPDATE list_checklist set checked_val=:checked_val where id=:list_id";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':list_id'=>$list_id,':checked_val'=>$checked_val);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}

			public function AddAttendance($student_id,$student,$date,$remarks,$timein,$timeout){

					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				// $shapass = $password;		
				$sql  	 = "INSERT INTO list_attendance (student_id,name,date,remarks,timein,timeout) VALUES(:student_id,:student,:date,:remarks,:timein,:timeout)";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':student_id'=>$student_id,':student'=>$student,':date'=>$date,':remarks'=>$remarks,':timein'=>$timein,':timeout'=>$timeout);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}


			public function CheckStudentAccount($id){

						if(!$this->OpenDB()){
							error_log("OPEN DB ERROR!");
							return false;
						}
				
				$sql = "Select * from portal_users where ss_id = :id";
				
				$q = $this->conn->prepare($sql);

				$value = array(':id'=>$id);
				
				$q->execute($value);

				$count = $q->rowCount();
				

				if($count != 0){
						return true;					

				}else{
					return false;
					
				}


				return false;
			}


			public function UploadMoa($student_id,$code,$name,$date_created){

					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				// $shapass = $password;		
				$sql  	 = "INSERT INTO list_requirements (student_id,code,name,date_created) VALUES(:student_id,:code,:name,:date_created)";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':student_id'=>$student_id,':code'=>$code,':name'=>$name,':date_created'=>$date_created);

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

$list = new Listing();


?>