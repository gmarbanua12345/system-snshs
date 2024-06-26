 <?php
require_once("../../include/initialize.php");
  if(!isset($_SESSION['ACCOUNT_ID'])){
  redirect(web_root."admin/index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SNHS Balugo Extension Enrollment System   </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="<?php echo web_root; ?>admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo web_root; ?>admin/css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo web_root; ?>admin/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo web_root; ?>admin/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
 
   <link href="<?php echo web_root; ?>admin/css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo web_root; ?>admin/font/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <link href="<?php echo web_root; ?>admin/font/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- DataTables CSS -->
    <link href="<?php echo web_root; ?>admin/css/dataTables.bootstrap.css" rel="stylesheet">
 
     <!-- datetime picker CSS -->
<link href="<?php echo web_root; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
 <link href="<?php echo web_root; ?>css/datepicker.css" rel="stylesheet" media="screen">
 
 <link href="<?php echo web_root; ?>admin/css/costum.css" rel="stylesheet">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!--  content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h4 class="page-header ">
          <i class="fa fa-globe"></i> SNHS Balugo Extension Enrollment System 
           <small class="pull-right">Printed Date: <?php echo date('m/d/Y'); ?></small>
        </h4>
      </div>
      <!-- /.col -->
    </div>

  <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header" align="center">
            Student Grades
             
          </h2>
        </div> 
      </div> 
<?php
if (isset($_POST['stud_id'])) {
  # code...

   $stud = New Student();
   $res = $stud->single_student($_POST['stud_id']);

   $course = New Course();
   $rescourse = $course->single_course($res->COURSE_ID);


   $studdetails = New StudentDetails();
    $resguardian = $studdetails->single_StudentDetails($_POST['stud_id']); 

}
 

?> 
       <div class="container">
        <table style="max-width:100%" cellpadding="4" cellspacing="7" class="table">
          <thead>
            <th><label>Student :</label></th><th  ><label><?php echo  $res->FNAME .'' . $res->LNAME;?></label></th> 
            <th></th>
            <th>Course</th><th><?php echo $rescourse->COURSE_NAME; ?></th>
            </thead>
           <thead> 
            <th>Year Level</th><th><?php echo $res->YEARLEVEL ?></th>
            </thead>
        </table>
      </div>
   
      <table class="table">
			<tr>
				<td>
					<label>ID</label>
				</td>
				<td colspan="2">
					<input class="form-control input-md" readonly id="IDNO" name="IDNO" placeholder="Student Id" type="text" value="<?php echo $res->IDNO ?>">
				</td>
				
			</tr>
			<tr>
				<td>
					<label>School Year</label>
				</td>
				<td colspan="2">
					<?php echo $_SESSION['SY'] ; ?>
				</td>
			</tr>
			<tr>
				<td>
					Check the appropriate box only:
					<label>With LRN?</label>
				</td>
				<td colspan="2">
					<br>
					<input type="radio" id="lrnYes" name="lrn" value="1" <?php if($res->LRN_NO == 1){ echo "checked"; } ?>>
					<label for="lrnYes">Yes</label>
					<input type="radio" id="lrnNo" name="lrn" value="0" <?php if($res->LRN_NO == 0){ echo "checked"; } ?>>
					<label for="lrnNo">No</label>
				</td>
			</tr>
			<tr>
				<td>
					<br>
					<label>Returning (Balik-Aral)</label>
				</td>
				<td colspan="2">
					<br>
					<input type="radio" id="returningYes" name="returning" value="1" <?php if($res->BALIK_ARAL == 1){ echo "checked"; } ?>>
					<label for="returningYes">Yes</label>
					<input type="radio" id="returningNo" name="returning" value="0" <?php if($res->BALIK_ARAL == 0){ echo "checked"; } ?>>
					<label for="returningNo">No</label>
				</td>
			</tr>
			<tr>
				<td>
					<label>Learner Reference No.:</label>
				</td>
				<td colspan="2" style="width:30%">
					<input type="text" name="lr_no" id="lr_no" class="form-control" value="<?php echo $res->LR_NO?>">
				</td>
			</tr>
			<tr>
				<td>
					<label>Grade to Enroll</label>
				</td>
				<td colspan="2">
					<select class="form-control" name="GRADE">
						<?php
							$course = New Course();
							$singlecourse = $course->single_course($res->COURSE_ID);
							if($singlecourse->COURSE_MAJOR != "N/A"){
								echo '<option value='.$singlecourse->COURSE_ID.' >'.$singlecourse->COURSE_NAME.' - Grade '.$singlecourse->COURSE_LEVEL.' ('.$singlecourse->COURSE_MAJOR.')</option>';
							}else{
								echo '<option value='.$singlecourse->COURSE_ID.' >'.$singlecourse->COURSE_NAME.' - Grade '.$singlecourse->COURSE_LEVEL.' </option>';
							}

					
						?>
						<?php 
						$mydb->setQuery("SELECT * FROM `course` WHERE COURSE_ID != '".$res->COURSE_ID."' ");
						$cur = $mydb->loadResultList();

						foreach ($cur as $result) {
							if($result->COURSE_MAJOR != "N/A"){
                                echo '<option value='.$result->COURSE_ID.' >'.$result->COURSE_NAME.' - Grade '.$result->COURSE_LEVEL.' ('.$result->COURSE_MAJOR.')</option>';
							}else{
								echo '<option value='.$result->COURSE_ID.' >'.$result->COURSE_NAME.' - Grade '.$result->COURSE_LEVEL.' </option>';
							}
						}
						?>
					</select> 
				</td>
			</tr>

			<tr>
				<td>
					<label>PSA Birth Certificate No.</label> (if available upon registration)
				</td>
				<td colspan="2">
					<input type="text" name="psa_no" id="psa_no" class="form-control" value="<?php $res->PSA_NO?>">
				</td>
				<td>
					<label for="psa_file">Upload PSA File:</label>
					<a href="<?php echo web_root . '' . $res->PSA_FILE ?>" class="image-link">
						<img title="PSA" class="img-hover" style="height:100px" src="<?php echo web_root . '' . $res->PSA_FILE ?>">
					</a>
					<input type="file" id="psa_file" name="psa_file"><br><br>
				</td>
			</tr>

			<tr>
				<td>
					<label>Name</label>
				</td>
				<td colspan="2">
					<input required="true"  class="form-control input-md" id="LNAME" name="LNAME" placeholder="Last Name" type="text" value="<?php echo $res->LNAME?>">
				</td> 
				<td>
					<input required="true"   class="form-control input-md" id="FNAME" name="FNAME" placeholder="First Name" type="text" value="<?php echo $res->FNAME?>">
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td colspan="2">
					<input class="form-control input-md" id="MNAME" name="MNAME" placeholder="Middle Name" type="text" value="<?php echo $res->MNAME?>">
				</td>
				<td colspan="">
					<input class="form-control input-md" id="EXT" name="EXT" placeholder="Extension " type="text" value="<?php echo $res->EXT?>">
				</td> 
			</tr>
			<tr>
				<td ><label>Sex </label></td> 
				<td colspan="">
					<label>
						<input <?php if($res->SEX == "Female"){ echo "checked"; } ?> id="optionsRadios1" name="sex" type="radio" value="Female">Female 
						<input <?php if($res->SEX == "Male"){ echo "checked"; } ?> id="optionsRadios2" name="sex" type="radio" value="Male"> Male
					</label>
				</td>
				
				<td style="text-align:right">
					<label>Age</label>
				</td>
				<td colspan=""> 
					<div class="input-group" >
						<input type="number" name="age" id="age" class="form-control input-md" value="<?php echo $res->AGE?>">
					</div>             
				</td>
			</tr>
			<tr>
				<td>
					<label>Date of birth</label>
				</td>
				<td colspan=""> 
					<div class="input-group" >
						<div class="input-group-addon"> 
							<i class="fa fa-calendar"></i>
						</div>
						<input  required="true" name="BIRTHDATE"  id="BIRTHDATE"  type="date" class="form-control input-md" value="<?php echo $res->BDAY?>">
					</div>             
				</td>
				<td>
					<label>Place of Birth</label><br>
					(Municipality/City)
				</td>
				<td colspan="">
					<input required="true"  class="form-control input-md" id="BIRTHPLACE" name="BIRTHPLACE" placeholder="Place of Birth" type="text" value="<?php echo $res->BPLACE?>">
				</td>
			</tr>
			<tr>
				<td>
					<label>Mother Tongue</label>
				</td>
				<td>
					<input type="text" name="mother_tongue" id="mother_tongue" class="form-control input-md" value="<?php echo $res->MOTHER_TONGUE?>">
				</td>
				
			</tr>
			<tr>
				<td colspan="2">
					<label>Belonging to any Indigenous Peoples (IP) Community / Indigenous Cultural Community</label><br>
					<input type="radio" id="ipYes" name="ip" value="1" <?php if(!empty($res->IP_NAME)){ echo "checked"; } ?>>
					<label for="ipYes">Yes</label>
					<input type="radio" id="ipNo" name="ip" value="0" <?php if(empty($res->IP_NAME)){ echo "checked"; } ?>>
					<label for="ipNo">No</label>
					
				</td>
				<td colspan="2">
					<label>If yes, please specify:</label><br>
					<input type="text" name="ip_name" id="ip_name" class="form-control input-md" VALUE="<?PHP echo $res->IP_NAME ?>" <?php if(empty($res->IP_NAME)){ echo "disabled"; } ?>>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<label>Is your family a beneficiary of 4Ps?</label><br>
					<input type="radio" id="4psYes" name="beneficiary" value="1" <?php if(!empty($res->BENEFICIARY_ID)){ echo "checked"; } ?>>
					<label for="4psYes">Yes</label>
					<input type="radio" id="4psNo" name="beneficiary" value="0" <?php if(empty($res->BENEFICIARY_ID)){ echo "checked"; } ?>>
					<label for="4psNo">No</label>
				</td>
				<td colspan="2">
					<label>If yes, write the 4Ps Household ID Number:</label><br>
					<input type="text" name="beneficiary_id" id="beneficiary_id" class="form-control input-md" VALUE="<?PHP echo $res->BENEFICIARY_ID ?>" <?php if(empty($res->BENEFICIARY_ID)){ echo "disabled"; } ?>>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<label>Is the child a Learner with disablity?</label><br>
					<input type="radio" id="disabilityYes" name="disability" value="1" <?php if(!empty($res->DISABILITY_NAME)){ echo "checked"; } ?>>
					<label for="disabilityYes">Yes</label>
					<input type="radio" id="disabilityNo" name="disability" value="0" <?php if(empty($res->DISABILITY_NAME)){ echo "checked"; } ?>>
					<label for="disabilityNo">No</label>
				</td>
				<td colspan="2">
					<label>If yes, specify the type of disablity:</label><br>
					<input type="text" name="disability_name" id="disability_name" class="form-control input-md" VALUE="<?PHP echo $res->DISABILITY_NAME ?>" <?php if(empty($res->DISABILITY_NAME)){ echo "disabled"; } ?>>
				</td>
			</tr>
			<tr>
				<td colspan="6">
					Address
				</td>
			</tr>
			<tr>
				<td><label>Current Address</label></td>
				<td colspan="5"  >
				<input required="true"  class="form-control input-md" id="CADDRESS" name="CADDRESS" placeholder="Permanent Address" type="text" value="<?php echo $res->CURRENT_ADD?>">
				</td> 
			</tr>
			<tr>
				<td>
					<label>Permanent Address</label>
				</td>
				<td colspan="5"  >
					<label>Same with your Current Address?</label>
					<input type="radio" id="addressYes" name="paddress" value="1" <?php if(!empty($res->PERMANENT_ADD)){ echo "checked"; } ?>>
					<label for="addressYes">Yes</label>
					<input type="radio" id="addressNo" name="paddress" value="0" <?php if(empty($res->PERMANENT_ADD)){ echo "checked"; } ?>>
					<label for="addressNo">No</label><br>
					<input required="true"  class="form-control input-md" id="PADDRESS" name="PADDRESS" placeholder="Permanent Address" type="text" value="<?php echo $res->PERMANENT_ADD?>"  <?php if(empty($res->PERMANENT_ADD)){ echo "disabled"; } ?>>
				</td> 
			</tr>

			
			<tr>
				<td colspan="6">
					Parent's/Guardian's Information
				</td>
			</tr>
			<tr>
				<td><label>Father's Name</label></td>
				<td colspan="">
					<input required="true"  class="form-control input-md" id="GUARDIAN1" name="GUARDIAN1" placeholder="Parents/Guardian Name" type="text"value="<?php echo $resguardian->GUARDIAN1 ?>">
				</td>
				<td><label>Contact No.</label></td>
				<td colspan=""><input  required="true" class="form-control input-md" id="GCONTACT1" name="GCONTACT1" placeholder="Contact Number" type="number" value="<?php echo $resguardian->GCONTACT1 ?>"></td>
			</tr>
			<tr>
				<td><label>Mother's Name</label></td>
				<td colspan="">
					<input required="true"  class="form-control input-md" id="GUARDIAN2" name="GUARDIAN2" placeholder="Parents/Guardian Name" type="text"value="<?php echo $resguardian->GUARDIAN2 ?>">
				</td>
				<td><label>Contact No.</label></td>
				<td colspan=""><input  required="true" class="form-control input-md" id="GCONTACT2" name="GCONTACT2" placeholder="Contact Number" type="number" value="<?php echo $resguardian->GCONTACT2 ?>"></td>
			</tr>
			<tr>
				<td><label>Legal Guardian's Name</label></td>
				<td colspan="">
					<input required="true"  class="form-control input-md" id="GUARDIAN3" name="GUARDIAN3" placeholder="Parents/Guardian Name" type="text" value="<?php echo $resguardian->GUARDIAN3 ?>">
				</td>
				<td><label>Contact No.</label></td>
				<td colspan=""><input  required="true" class="form-control input-md" id="GCONTACT3" name="GCONTACT3" placeholder="Contact Number" type="number" value="<?php echo $resguardian->GCONTACT3 ?>"></td>
			</tr>
			</form>
			<tr>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

        </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
