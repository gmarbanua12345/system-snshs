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
  
 
	}
   
	function doInsert(){
		if(isset($_POST['save'])){


			if ($_POST['INST_NAME'] == "") {
				message("All field is required!","error");
				redirect('index.php?view=add');
			}else{	
				$inst = New Instructor(); 

				if($inst->find_all_instructor($_POST['INST_NAME'] > 0)){
					message("Teacher already exist!","error");
					redirect('index.php?view=add');
				}else{
					$inst->INST_NAME 	= $_POST['INST_NAME'];
					$inst->create();

					message("New  instructor created successfully!", "success");
					redirect("index.php");
				}
				
				//$inst->INST_MAJOR	= $_POST['INST_MAJOR']; 
				//$inst->INST_CONTACT	= $_POST['INST_CONTACT']; 
			}
		}

	}

	function doEdit(){
	if(isset($_POST['save'])){
		$inst = New Instructor();
		if($inst->find_duplicate($_POST['INST_NAME'], $_POST['INST_ID']) > 0){
			message("Teacher already exist!","error");
			//redirect("index.php");
			redirect('index.php?view=edit&id='.$_SESSION['COURSE_ID']);
		}else{
			$inst->INST_NAME 	= $_POST['INST_NAME'];
			$inst->update($_POST['INST_ID']);

			message("Instructor has been updated!", "success");
			redirect("index.php");
		}
			
			
			//$inst->INST_MAJOR	= $_POST['INST_MAJOR']; 
			//$inst->INST_CONTACT	= $_POST['INST_CONTACT']; 
	
		}
	}


	function doDelete(){
	 	$id = 	$_GET['id'];

				$inst = New Instructor();
	 		 	$inst->delete($id);
			 
			message("Instructor already Deleted!","info");
			redirect('index.php');
		 
		
	}
  
 
?>