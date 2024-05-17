<?php
require_once ("../../include/initialize.php");
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;
	
	case 'edit' :
	doEdit();
	break;

	case 'addgrade' :
	doUpdateGrades();
	break;

	case 'addvalue' :
	doUpdateValues();
	break;
	
	case 'delete' :
	doDelete();
	break;

	case 'photos' :
	doupdateimage();
	break;

 
	}
   
	function doInsert(){
		global $mydb;
		if(isset($_POST['save'])){


		if ($_POST['SUBJ_CODE'] == "" OR $_POST['SUBJ_DESCRIPTION'] == "" OR $_POST['UNIT'] == ""
			OR $_POST['PRE_REQUISITE'] == "" OR $_POST['COURSE_ID'] == "none"  OR $_POST['AY'] == ""  
			OR $_POST['SEMESTER'] == "" ) {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php?view=add');
		}else{	
			$subj = New Subject();
			// $subj->USERID 		= $_POST['user_id'];
			$subj->SUBJ_CODE 		= $_POST['SUBJ_CODE'];
			$subj->SUBJ_DESCRIPTION	= $_POST['SUBJ_DESCRIPTION']; 
			$subj->UNIT				= $_POST['UNIT'];
			$subj->PRE_REQUISITE 	= $_POST['PRE_REQUISITE'];
			$subj->COURSE_ID		= $_POST['COURSE_ID']; 
			$subj->AY				= $_POST['AY']; 
			$subj->SEMESTER			= $_POST['SEMESTER'];
			$subj->create();

						// $autonum = New Autonumber();  `SUBJ_ID`, `SUBJ_CODE`, `SUBJ_DESCRIPTION`, `UNIT`, `PRE_REQUISITE`, `COURSE_ID`, `AY`, `SEMESTER`
						// $autonum->auto_update(2);

			message("New [". $_POST['SUBJ_CODE'] ."] created successfully!", "success");
			redirect("index.php");
			
		}
		}

	}

	function doEdit(){
		global $mydb;

	if(isset($_POST['save'])){

		$stud = New Student();
		if(isset($_FILES['psa_file']) && $_FILES['psa_file']['error'] === UPLOAD_ERR_OK) {
			$tmp_file_path = $_FILES['psa_file']['tmp_name'];
			$uploads_directory = 'uploads/'; 
			$file_name = $_FILES['psa_file']['name'];
			$destination = $uploads_directory . $file_name;
			if(move_uploaded_file($tmp_file_path, $destination)) {
				$_POST['psa_file'] = $destination;
			} else {
				echo "Error moving uploaded file.";
			}
			$stud->PSA_FILE 			= $_POST['psa_file'];
		}

		$stud->FNAME 			= $_POST['FNAME'];
		$stud->LNAME 			= $_POST['LNAME'];
		$stud->MNAME 			= $_POST['MNAME'];
		$stud->EXT 				= $_POST['EXT'];
		$stud->LRN_NO 			= $_POST['lrn'];
		$stud->BALIK_ARAL 		= $_POST['returning'];
		$stud->PSA_NO 			= $_POST['psa_no'];
		$stud->LR_NO 			= $_POST['lr_no'];
		$stud->SEX 				= $_POST['sex'];
		$stud->BDAY 				= $_POST['BIRTHDATE'];
		$stud->BPLACE 			= $_POST['BIRTHPLACE'];
		//$stud->AGE 				= $_POST['age'];
		$stud->MOTHER_TONGUE 	= $_POST['mother_tongue'];
		if($_POST['ip'] == 1){
			$stud->IP_NAME 	= $_POST['ip_name'];
		}else{
			$stud->IP_NAME 	= "";
		}

		if($_POST['beneficiary'] == 1){
			$stud->BENEFICIARY_ID 	= $_POST['beneficiary_id'];
		}else{
			$stud->BENEFICIARY_ID 	= "";
		}
	
		if($_POST['disability'] == 1){
			$stud->DISABILITY_NAME 	= $_POST['disability_name'];
		}else{
			$stud->DISABILITY_NAME 	= "";
		}
		$stud->CURRENT_ADD 		= $_POST['CADDRESS'];
		$stud->PERMANENT_ADD 	= $_POST['PADDRESS'];
		$stud->COURSE_ID			= $_POST['GRADE'];
		$stud->update($_POST['IDNO']);


		$studetails = New StudentDetails();
		$studetails->GUARDIAN1 = $_POST['GUARDIAN1'];
		$studetails->GUARDIAN2 = $_POST['GUARDIAN2'];
		$studetails->GUARDIAN3 = $_POST['GUARDIAN3'];
		$studetails->GCONTACT1 = $_POST['GCONTACT1']; 
		$studetails->GCONTACT2 = $_POST['GCONTACT2']; 
		$studetails->GCONTACT3 = $_POST['GCONTACT3'];
		$studetails->update($_POST['IDNO']);

		message("Student has been updated!", "success");
		redirect("index.php?view=view&id=".$_POST['IDNO']);
 
			
	 
// }

		}
	}


	function doDelete(){
		global $mydb;
		
		// if (isset($_POST['selector'])==''){
		// message("Select the records first before you delete!","info");
		// redirect('index.php');
		// }else{

		// $id = $_POST['selector'];
		// $key = count($id);

		// for($i=0;$i<$key;$i++){

		// 	$subj = New User();
		// 	$subj->delete($id[$i]);

		
				$id = 	$_GET['id'];

				$subj = New Subject();
	 		 	$subj->delete($id);
			 
			message("User already Deleted!","info");
			redirect('index.php');
		// }
		// }

		
	}

	function doUpdateGrades(){
		global $mydb;

		if(isset($_POST['save'])){ 
			$remark = '';
			if($_POST['AVERAGE']>=75){
				$remark = 'Passed';
			}else{
				$remark = 'Failed';
			}

			$grade = New Grade(); 
			$grade->FIRST 				= $_POST['FIRSTGRADING'];
			$grade->SECOND				= $_POST['SECONDGRADING']; 
			$grade->THIRD				= $_POST['THIRDGRADING'];
			$grade->FOURTH 				= $_POST['FOURTHGRADING'];
			$grade->AVE					= $_POST['AVERAGE']; 
			$grade->REMARKS				= $remark;  
			$grade->update($_POST['GRADEID']);


			$studentsubject = New StudentSubjects(); 
			$studentsubject->AVERAGE	= $_POST['AVERAGE'];
			$studentsubject->OUTCOME 	=  $remark; 
			$studentsubject->updateSubject($_POST['SUBJ_ID'],$_POST['IDNO']);

			$subject = New Subject();
			$res = $subject->single_subject($_POST['SUBJ_ID']);

			$sql = "SELECT sum(`UNIT`) as 'Unit' FROM `subject`  WHERE COURSE_ID=".$res->COURSE_ID." AND SEMESTER='".$res->SEMESTER."'";
			$cur = mysqli_query($mydb->conn,$sql);
			$unitresult = mysqli_fetch_assoc($cur);

			$sql = "SELECT sum(`UNIT`) as 'Unit' FROM `studentsubjects`  st,`subject` s 
			WHERE st.`SUBJ_ID`=s.`SUBJ_ID` AND COURSE_ID=".$res->COURSE_ID." AND s.SEMESTER='".$res->SEMESTER."' AND AVERAGE > 74 AND IDNO=".$_POST['IDNO'];
			$cur = mysqli_query($mydb->conn,$sql);
			$stufunitresult = mysqli_fetch_assoc($cur);

			if ($unitresult['Unit']<>$stufunitresult['Unit']) {
				$student = New Student(); 
				$student->student_status ='Irregular'; 
				$student->update($_POST['IDNO']);
			}else{
					# code...
				$student = New Student(); 
				$student->student_status ='Regular'; 
				$student->update($_POST['IDNO']);
			}

			if ($res->SEMESTER<>'First') {
				$sql = "SELECT (sum(unit)/2) as 'Unit' FROM `subject`  WHERE COURSE_ID=".$res->COURSE_ID;;
				$cur = mysqli_query($mydb->conn,$sql);
				$unitresult = mysqli_fetch_assoc($cur);


				$sql = "SELECT sum(`UNIT`) as 'Unit' FROM `studentsubjects`  st,`subject` s 
				WHERE st.`SUBJ_ID`=s.`SUBJ_ID` AND COURSE_ID=".$res->COURSE_ID."  AND AVERAGE > 74 AND IDNO=".$_POST['IDNO'];
				$cur = mysqli_query($mydb->conn,$sql);
				$stufunitresult = mysqli_fetch_assoc($cur);

				if ($unitresult['Unit'] < $stufunitresult['Unit']) {
					# code...
					$course = New Course();
					$courseresult = $course->single_course($res->COURSE_ID);
					switch ($courseresult->COURSE_LEVEL) {
						case 1:
							# code...
						$sql = "SELECT * FROM `course`  WHERE COURSE_NAME='".$courseresult->COURSE_NAME."' AND COURSE_LEVEL=2"; 
						$cur = mysqli_query($mydb->conn,$sql);
						$studcourse = mysqli_fetch_assoc($cur);

							$student = New Student(); 
							$student->COURSE_ID =$studcourse['COURSE_ID'];
							$student->YEARLEVEL =$studcourse['COURSE_LEVEL'];  
							$student->update($_POST['IDNO']);

							break;
						case 2:
							# code...

						$sql = "SELECT * FROM `course`  WHERE COURSE_NAME='".$courseresult->COURSE_NAME."' AND COURSE_LEVEL=3"; 
						$cur = mysqli_query($mydb->conn,$sql);
						$studcourse = mysqli_fetch_assoc($cur);

							$student = New Student(); 
							$student->COURSE_ID =$studcourse['COURSE_ID'];
							$student->YEARLEVEL =$studcourse['COURSE_LEVEL'];  
							$student->update($_POST['IDNO']);

							break;
						case 3:
							# code...

						$sql = "SELECT * FROM `course`  WHERE COURSE_NAME='".$courseresult->COURSE_NAME."' AND COURSE_LEVEL=4"; 
						$cur = mysqli_query($mydb->conn,$sql);
						$studcourse = mysqli_fetch_assoc($cur);

							$student = New Student(); 
							$student->COURSE_ID =$studcourse['COURSE_ID']; 
							$student->YEARLEVEL =$studcourse['COURSE_LEVEL']; 
							$student->update($_POST['IDNO']);

							break;
						
						default:
							# code...
							break;
							$sql = "SELECT * FROM `course`  WHERE COURSE_NAME='".$courseresult->COURSE_NAME."' AND COURSE_LEVEL=1"; 
							$cur = mysqli_query($mydb->conn,$sql);
							$studcourse = mysqli_fetch_assoc($cur);

								$student = New Student(); 
								$student->COURSE_ID =$studcourse['COURSE_ID']; 
								$student->YEARLEVEL =$studcourse['COURSE_LEVEL']; 
								$student->update($_POST['IDNO']);
					}
				}
			}
			message("[". $_POST['SUBJ_CODE'] ."] has been updated!", "success");
			redirect("index.php?view=grades&id=".$_POST['IDNO']);
		}
	} 

	function doUpdateValues(){
		global $mydb;

		if(isset($_POST['save'])){ 

			$sql = "UPDATE `corevalues` SET
						`FIRST` = '".$_POST['FIRSTGRADING']."',
						`SECOND` = '".$_POST['SECONDGRADING']."',
						`THIRD` = '".$_POST['THIRDGRADING']."',
						`FOURTH` = '".$_POST['FOURTHGRADING']."'
						WHERE `V_ID` = '".$_POST['V_ID']."'";
			
			$res = mysqli_query($mydb->conn,$sql) or die(mysqli_error($mydb->conn));


			message("[". $_POST['CORE_VALUE'] ."] has been updated!", "success");
			redirect("index.php?view=grades&id=".$_POST['IDNO']);
		}
	} 
?>