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
	
	case 'delete' :
	doDelete();
	break;

	case 'photos' :
	doupdateimage();
	break;

 
	}
   
	function doInsert(){
		if(isset($_POST['save'])){
			
			if ($_POST['COURSE_NAME'] == "" OR $_POST['COURSE_LEVEL'] == "" OR $_POST['DEPT_ID'] == "none") {
				$messageStats = false;
				message("All field is required!","error");
				redirect('index.php?view=add');
			}else{	
				$course = New Course();
				if($course->find_all_course($_POST['COURSE_NAME'], $_POST['COURSE_LEVEL'], $_POST['COURSE_MAJOR']) > 0){
					$messageStats = false;
					message("Grade details already exist!","error");
					redirect('index.php?view=add');
				}else{
					$course->COURSE_NAME 		= $_POST['COURSE_NAME'];
					$course->COURSE_LEVEL		= $_POST['COURSE_LEVEL'];
					$course->COURSE_MAJOR		= $_POST['COURSE_MAJOR'];
					$course->COURSE_DESC		= $_POST['COURSE_DESC']; 
					$course->DEPT_ID			= $_POST['DEPT_ID'];
					$course->create();

					message("New Grade No: [". $_POST['COURSE_NAME'] ."] created successfully!", "success");
					redirect("index.php");
				}
			}
		}

	}

	function doEdit(){
		if(isset($_POST['save'])){
			$course = New Course(); 
			if($course->find_duplicate($_POST['COURSE_NAME'], $_POST['COURSE_LEVEL'], $_POST['COURSE_MAJOR'], $_POST['COURSE_ID']) > 0){
				$messageStats = false;
				message("Grade details already exist!","error");
				//redirect("index.php");
				redirect('index.php?view=edit&id='.$_SESSION['COURSE_ID']);
			}else{
				$course = New Course(); 
				$course->COURSE_NAME 		= $_POST['COURSE_NAME'];
				$course->COURSE_LEVEL		= $_POST['COURSE_LEVEL'];
				$course->COURSE_MAJOR		= $_POST['COURSE_MAJOR'];
				$course->COURSE_DESC		= $_POST['COURSE_DESC'];
				$course->DEPT_ID			= $_POST['DEPT_ID'];
				$course->update($_POST['COURSE_ID']);

				message("[". $_POST['COURSE_NAME'] ."] has been updated!", "success");
				redirect('index.php?view=edit&id='.$_SESSION['COURSE_ID']);
			}
		}
	}


	function doDelete(){
		
		// if (isset($_POST['selector'])==''){
		// message("Select the records first before you delete!","info");
		// redirect('index.php');
		// }else{

		// $id = $_POST['selector'];
		// $key = count($id);

		// for($i=0;$i<$key;$i++){

		// 	$course = New User();
		// 	$course->delete($id[$i]);

		
				$id = 	$_GET['id'];

				$course = New Course();
	 		 	$course->delete($id);
			 
			message("Course already Deleted!","info");
			redirect('index.php');
		// }
		// }

		
	}

	 
?>