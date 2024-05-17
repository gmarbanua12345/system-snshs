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


		if ($_POST['SUBJ_CODE'] == "" OR $_POST['SUBJ_DESCRIPTION'] == "" OR$_POST['COURSE_ID'] == "none" ) {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php?view=add');
		}else{	
			$subj = New Subject();

			if($subj->find_all_subject($_POST['SUBJ_CODE'], $_POST['COURSE_ID']) > 0){
				$messageStats = false;
				message("Subject already exist in this Grade level!","error");
				redirect('index.php?view=add');
			}else{
				$subj->SUBJ_CODE 		= $_POST['SUBJ_CODE'];
				$subj->SUBJ_DESCRIPTION	= $_POST['SUBJ_DESCRIPTION']; 
				$subj->COURSE_ID		= $_POST['COURSE_ID'];
				$subj->create(); 

				message("New [". $_POST['SUBJ_CODE'] ."] created successfully!", "success");
				redirect("index.php");
			}
			// $subj->USERID 		= $_POST['user_id'];
			
			//
			//$subj->UNIT				= $_POST['UNIT'];
			//$subj->PRE_REQUISITE 	= $_POST['PRE_REQUISITE'];
			
			// $subj->AY				= $_POST['AY']; 
			//$subj->SEMESTER			= $_POST['SEMESTER'];
			

						// $autonum = New Autonumber();  `SUBJ_ID`, `SUBJ_CODE`, `SUBJ_DESCRIPTION`, `UNIT`, `PRE_REQUISITE`, `COURSE_ID`, `AY`, `SEMESTER`
						// $autonum->auto_update(2);
			}
		}

	}

	function doEdit(){
	if(isset($_POST['save'])){

			$subj = New Subject(); 
			if($subj->find_duplicate($_POST['SUBJ_CODE'], $_POST['COURSE_ID'], $_POST['SUBJ_ID']) > 0){
				message("Subject details already exist!","error");
				//redirect("index.php");
				redirect('index.php?view=edit&id='.$_POST['COURSE_ID']);
			}else{
				$subj->SUBJ_CODE 		= $_POST['SUBJ_CODE'];
				$subj->SUBJ_DESCRIPTION	= $_POST['SUBJ_DESCRIPTION']; 
				$subj->COURSE_ID		= $_POST['COURSE_ID']; 
				$subj->update($_POST['SUBJ_ID']);
				message("[". $_POST['SUBJ_CODE'] ."] has been updated!", "success");
				redirect('index.php?view=edit&id='.$_POST['COURSE_ID']);
			}
			
			//
			//$subj->UNIT				= $_POST['UNIT'];
			//$subj->PRE_REQUISITE 	= $_POST['PRE_REQUISITE'];
			
			// $subj->AY				= $_POST['AY']; 
			//$subj->SEMESTER			= $_POST['SEMESTER'];
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

		// 	$subj = New User();
		// 	$subj->delete($id[$i]);

		
				$id = 	$_GET['id'];

				$subj = New Subject();
	 		 	$subj->delete($id);
			 
			message("Subject already Deleted!","info");
			redirect('index.php');
		// }
		// }

		
	}
 
 
?>