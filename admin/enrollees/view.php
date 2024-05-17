<?php  
require_once("../../include/initialize.php");
    if (!isset($_GET['IDNO'])){
    redirect(web_root."admin/index.php");
    }
?>
<br/>
<?php
$student = New Student();
$res = $student->single_student($_GET['IDNO']);

$studdetails = New StudentDetails();
$details = $studdetails->single_StudentDetails($_GET['IDNO']); 

?>
 

	<div class="table-responsive">
	<div class="col-md-8"><h2>Update Accounts</h2></div>
	<div class="col-md-4"><label>Academic Year - <?php echo $res->ENROLL_YEAR ; ?></label></div>
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
					<?php echo $res->ENROLL_YEAR ; ?>
				</td>
			</tr>
			<tr>
				<td>
					Check the appropriate box only:
					<label>With LRN?</label>
				</td>
				<td colspan="2">
					<br>
                    <?php 
                    if($res->LRN_NO == 1){ 
                        echo "<input type='text' value='Yes' class='form-control' disabled>"; 
                    } 
                    if($res->LRN_NO == 0){ 
                        echo "<input type='text' value='No' class='form-control' disabled>"; 
                    } 
                    ?>
				</td>
			</tr>
			<tr>
				<td>
					<br>
					<label>Returning (Balik-Aral)</label>
				</td>
				<td colspan="2">
					<br>
                    <?php 
                    if($res->BALIK_ARAL == 1){ 
                        echo "<input type='text' value='Yes' class='form-control' disabled>"; 
                    } 
                    if($res->BALIK_ARAL == 0){ 
                        echo "<input type='text' value='No' class='form-control' disabled>"; 
                    } 
                    ?>
				</td>
			</tr>
			<tr>
				<td>
					<label>Learner Reference No.:</label>
				</td>
				<td colspan="2" style="width:30%">
					<input type="text" name="lr_no" id="lr_no" class="form-control" value="<?php echo $res->LR_NO?>" disabled>
				</td>
			</tr>
			<tr>
				<td>
					<label>Grade to Enroll</label>
				</td>
				<td colspan="2">
                    <?php
                        $course = New Course();
                        $singlecourse = $course->single_course($res->ENROLL_LEVEL);
                        if($singlecourse->COURSE_MAJOR != "N/A"){
                            echo '<input value="'.$singlecourse->COURSE_NAME.' - Grade '.$singlecourse->COURSE_LEVEL.' ('.$singlecourse->COURSE_MAJOR.')'.'" disabled class="form-control>';
                        }else{
                            echo '<input value="'.$singlecourse->COURSE_NAME.' - Grade '.$singlecourse->COURSE_LEVEL.'" disabled class="form-control">';
                            
                        }
                    ?>
				</td>
				<td>
					<label for="psa_file">Previous Report Card:</label>
					<a href="<?php echo web_root . '' . $res->REPORT_CARD ?>" class="image-link">
						<img title="PSA" class="img-hover" style="height:100px" src="<?php echo web_root . '' . $res->REPORT_CARD ?>">
					</a>
				</td>
			</tr>

			<tr>
				<td>
					<label>PSA Birth Certificate No.</label> (if available upon registration)
				</td>
				<td colspan="2">
					<input type="text" name="psa_no" id="psa_no" class="form-control" value="<?php echo $res->PSA_NO?>" disabled>
				</td>
				<td>
					<label for="psa_file">PSA File:</label>
					<a href="<?php echo web_root . '' . $res->PSA_FILE ?>" class="image-link">
						<img title="PSA" class="img-hover" style="height:100px" src="<?php echo web_root . '' . $res->PSA_FILE ?>">
					</a>
				</td>
			</tr>

			<tr>
				<td>
					<label>Name</label>
				</td>
				<td colspan="2">
					<input required="true"  class="form-control input-md" id="LNAME" name="LNAME" placeholder="Last Name" type="text" value="<?php echo $res->LNAME?>" disabled>
				</td> 
				<td>
					<input required="true"   class="form-control input-md" id="FNAME" name="FNAME" placeholder="First Name" type="text" value="<?php echo $res->FNAME?>" disabled>
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td colspan="2">
					<input class="form-control input-md" id="MNAME" name="MNAME" placeholder="Middle Name" type="text" value="<?php echo $res->MNAME?>" disabled>
				</td>
				<td colspan="">
					<input class="form-control input-md" id="EXT" name="EXT" placeholder="Extension " type="text" value="<?php echo $res->EXT?>" disabled>
				</td> 
			</tr>
			<tr>
				<td ><label>Sex </label></td> 
				<td colspan="">
					<label>
                    <?php 
                    if($res->SEX == "Female"){ 
                        echo "<input type='text' value='Female' class='form-control' disabled>"; 
                    } 
                    if($res->SEX == "Male"){ 
                        echo "<input type='text' value='Male' class='form-control' disabled>"; 
                    } 
                    ?>
					</label>
				</td>
				
				<!--<td style="text-align:right">
					<label>Age</label>
				</td>
				<td colspan=""> 
					<div class="input-group" >
						<input type="number" name="age" id="age" class="form-control input-md" value="<?php echo $res->AGE?>" disabled>
					</div>             
				</td>-->
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
						<input  required="true" name="BIRTHDATE"  id="BIRTHDATE"  type="date" class="form-control input-md" value="<?php echo $res->BDAY?>" disabled>
					</div>             
				</td>
				<td>
					<label>Place of Birth</label><br>
					(Municipality/City)
				</td>
				<td colspan="">
					<input required="true"  class="form-control input-md" id="BIRTHPLACE" name="BIRTHPLACE" placeholder="Place of Birth" type="text" value="<?php echo $res->BPLACE?>" disabled>
				</td>
			</tr>
			<tr>
				<td>
					<label>Mother Tongue</label>
				</td>
				<td>
					<input type="text" name="mother_tongue" id="mother_tongue" class="form-control input-md" value="<?php echo $res->MOTHER_TONGUE?>" disabled>
				</td>
				
			</tr>
			<tr>
				<td colspan="2">
					<label>Belonging to any Indigenous Peoples (IP) Community / Indigenous Cultural Community</label><br>
                    <?php 
                    if(!empty($res->IP_NAME)){ 
                        echo "<input type='text' value='Yes' class='form-control' disabled>"; 
                    } 
                    if(empty($res->IP_NAME)){ 
                        echo "<input type='text' value='No' class='form-control' disabled>"; 
                    }
                    ?>
				</td>
				<td colspan="2">
					<label>If yes, please specify:</label><br>
					<input type="text" name="ip_name" id="ip_name" class="form-control input-md" VALUE="<?PHP echo $res->IP_NAME ?>" <?php  echo "disabled";  ?>>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<label>Is your family a beneficiary of 4Ps?</label><br>
                    <?php
                    if(!empty($res->BENEFICIARY_ID)){ 
                        echo "<input type='text' value='Yes' class='form-control' disabled>"; 
                    } 
                    if(empty($res->BENEFICIARY_ID)){ 
                        echo "<input type='text' value='No' class='form-control' disabled>"; 
                    }
                    ?>
				</td>
				<td colspan="2">
					<label>If yes, write the 4Ps Household ID Number:</label><br>
					<input type="text" name="beneficiary_id" id="beneficiary_id" class="form-control input-md" VALUE="<?PHP echo $res->BENEFICIARY_ID ?>" <?php echo "disabled";  ?>>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<label>Is the child a Learner with disablity?</label><br>
                    <?php
                    if(!empty($res->DISABILITY_NAME)){ 
                        echo "<input type='text' value='Yes' class='form-control' disabled>"; 
                    } 
                    if(empty($res->DISABILITY_NAME)){ 
                        echo "<input type='text' value='No' class='form-control' disabled>"; 
                    }
                    ?>
				</td>
				<td colspan="2">
					<label>If yes, specify the type of disablity:</label><br>
					<input type="text" name="disability_name" id="disability_name" class="form-control input-md" VALUE="<?PHP echo $res->DISABILITY_NAME ?>" <?php  echo "disabled";  ?>>
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
				<input required="true"  class="form-control input-md" id="CADDRESS" name="CADDRESS" placeholder="Permanent Address" type="text" value="<?php echo $res->CURRENT_ADD?>" disabled>
				</td> 
			</tr>
			<tr>
				<td>
					<label>Permanent Address</label>
				</td>
				<td colspan="5"  >
					<input required="true"  class="form-control input-md" id="PADDRESS" name="PADDRESS" placeholder="Permanent Address" type="text" value="<?php echo $res->PERMANENT_ADD?>"  <?php  echo "disabled";  ?>>
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
					<input required="true"  class="form-control input-md" id="GUARDIAN1" name="GUARDIAN1" placeholder="Parents/Guardian Name" type="text"value="<?php echo $details->GUARDIAN1 ?>" disabled>
				</td>
				<td><label>Contact No.</label></td>
				<td colspan=""><input  required="true" class="form-control input-md" id="GCONTACT1" name="GCONTACT1" placeholder="Contact Number" type="number" value="<?php echo $details->GCONTACT1 ?>" disabled></td>
			</tr>
			<tr>
				<td><label>Mother's Name</label></td>
				<td colspan="">
					<input required="true"  class="form-control input-md" id="GUARDIAN2" name="GUARDIAN2" placeholder="Parents/Guardian Name" type="text"value="<?php echo $details->GUARDIAN2 ?>" disabled>
				</td>
				<td><label>Contact No.</label></td>
				<td colspan=""><input  required="true" class="form-control input-md" id="GCONTACT2" name="GCONTACT2" placeholder="Contact Number" type="number" value="<?php echo $details->GCONTACT2 ?>" disabled></td>
			</tr>
			<tr>
				<td><label>Legal Guardian's Name</label></td>
				<td colspan="">
					<input required="true"  class="form-control input-md" id="GUARDIAN3" name="GUARDIAN3" placeholder="Parents/Guardian Name" type="text" value="<?php echo $details->GUARDIAN3 ?>" disabled>
				</td>
				<td><label>Contact No.</label></td>
				<td colspan=""><input  required="true" class="form-control input-md" id="GCONTACT3" name="GCONTACT3" placeholder="Contact Number" type="number" value="<?php echo $details->GCONTACT3 ?>" disabled></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="5">	
                    <a title="View Grades" href="controller.php?action=confirm&IDNO=<?php echo $res->IDNO ?>" class="btn btn-success btn-lg" >Confirm <span class="fa fa-info-circle fw-fa"></span> </a>
				</td>
			</tr>
		</table>
	</div>
