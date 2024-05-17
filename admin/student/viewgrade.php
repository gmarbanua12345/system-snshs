<?php  
     if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

  @$IDNO = $_GET['id'];
    if($IDNO==''){
  redirect("index.php");
}
  $student = New Student();
  $res = $student->single_student($IDNO);
  
?>

<div class="row">
 <div class="col-lg-12">
 <div class="col-md-6">
 	<h2 ><?php echo   $res->LNAME.','. $res->FNAME.' '. $res->MNAME; ?></h2>
       <hr/>  
 </div>

 <?php 
$sql =" SELECT * FROM  `schoolyr` sy, `course` c,`department` d 
       WHERE  sy.`COURSE_ID`=c.`COURSE_ID` AND c.`DEPT_ID`=d.`DEPT_ID` AND sy.`IDNO`=".$IDNO." ORDER BY sy.SYID desc";
$mydb->setQuery($sql);

$cur = $mydb->loadSingleResult(); 
 ?>
              
  </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
  	<div class="col-md-6">
  		<h4>Course/Year :<?php echo $cur->COURSE_NAME.' - Grade '.$cur->COURSE_LEVEL;?> </h4>
  	</div>
  	<div class="col-md-6">
  		<h4>Department :<?php echo $cur->DEPARTMENT_NAME . ' [ '. $cur->DEPARTMENT_DESC. ' ]';?> </h4>
  	</div>
  </div>
	
</div>
<div class="row">
      <div class="col-lg-3"> 
            <h3 class="page-header">Student Subjects </h3>
       	 
       		</div>
        	<!-- /.col-lg-12 -->
   		 	    <form action="controller.php?action=delete" Method="POST">  
			      <div class="table-responsive">			
				<table id="dash-table" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
				
				  <thead>
				  	<tr>
				  		<th>ID</th>
				  		<th>
				  		 <!-- <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">  -->
				  		
				  		 Subject</th>
				  		<th>Description</th> 
				  		<th>First</th>
				  		<th>Second</th>
				  		<th>Third</th> 
				  		<th>Fourth</th>
				  		<th>Average</th>
				  		<th>Remarks</th>


				  		<th width="10%" >Action</th>
				 
				  	</tr>	
				  </thead> 
				  <tbody>
				  	<?php  
				  	// `GRADE_ID`, `IDNO`, `SUBJ_ID`, `INST_ID`, `SYID`,
				  	//  `FIRST`, `SECOND`, `THIRD`, `FOURTH`, `AVE`, `DAY`, `G_TIME`, `ROOM`, `REMARKS`, `COMMENT`
					  $latestYear = "SELECT MAX(SY) as max_year FROM studentsubjects INNER JOIN tblstudent ON tblstudent.IDNO = studentsubjects.IDNO WHERE studentsubjects.IDNO =" .$IDNO;
					  $yearQuery = mysqli_query($mydb->conn,$latestYear) or die(mysqli_error($mydb->conn));
					  $yearRes = mysqli_fetch_assoc($yearQuery);

						$sql = "SELECT * 
							FROM `tblstudent` st, `grades` g, `subject` s, `studentsubjects` ss
							WHERE st.`IDNO` = g.`IDNO` 
							AND g.`SUBJ_ID` = s.`SUBJ_ID`  
							AND s.`SUBJ_ID` = ss.`SUBJ_ID` 
							AND g.`IDNO` = ss.`IDNO` 
							AND st.`IDNO` = ".$IDNO." 
							AND ss.`SY` = '".$yearRes['max_year']."'";
						$mydb->setQuery($sql);

				  		$cur = $mydb->loadResultList();

						foreach ($cur as $result) {
				  		echo '<tr>';
				  		// echo '<td width="5%" align="center"></td>';
				  		echo '<td>' . $result->SUBJ_ID.'</a></td>';
				  		echo '<td>'. $result->SUBJ_CODE.'</td>';
				  		echo '<td>'. $result->SUBJ_DESCRIPTION.'</td>';
				  		echo '<td>'. $result->FIRST.'</td>';
				  		echo '<td>'. $result->SECOND.'</td>';
				  		echo '<td>' . $result->THIRD.'</a></td>';
				  		echo '<td>'. $result->FOURTH.'</td>'; 
				  		echo '<td>'. $result->AVE.'</td>'; 
				  		echo '<td>'. $result->REMARKS.'</td>'; 

						echo '<td align="center" > <a  title="Edit" href="addmodalgrades.php?id='.$result->SUBJ_ID.'&IDNO='.$result->IDNO.'&gid='.$result->GRADE_ID.'" data-toggle="lightbox" >  <span class="fa fa-plus fw-fa"></span> Add gardes</a></td>';

				  		echo '</tr>';
				  	} 
				  	?>
				  </tbody>
					
				</table>

				<table id="dash-table" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
					<thead>
						<tr>
							<th>Core Value</th>
							<th>Behavior Statements</th>
							<th>First</th>
							<th>Second</th>
							<th>Third</th>
							<th>Quarter</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php

						$sql = "SELECT * 
						FROM tblstudent
						INNER JOIN corevalues ON tblstudent.IDNO = corevalues.IDNO
						INNER JOIN tblvalues ON tblvalues.VALUE_ID = corevalues.VALUE_ID
						INNER JOIN studentvalues ON tblvalues.VALUE_ID = studentvalues.VALUE_ID
						WHERE tblstudent.IDNO = '{$IDNO}' 
						AND studentvalues.SY = '{$yearRes['max_year']}'
						GROUP BY corevalues.VALUE_ID";

						$sqlQuery = mysqli_query($mydb->conn,$sql) or die(mysqli_error($mydb->conn));

						while ($row = mysqli_fetch_array($sqlQuery)) {

							echo "<tr>";
							echo '<td>'. $row['CORE_VALUE'].'</td>';
							echo '<td>'. $row['STATEMENT1'].'<br>'.$row['STATEMENT2'].'</td>';
							echo '<td>'. $row['FIRST'].'</td>';
							echo '<td>'. $row['SECOND'].'</td>';
							echo '<td>'. $row['THIRD'].'</td>';
							echo '<td>'. $row['FOURTH'].'</td>';
							echo '<td align="center" > <a  title="Edit" href="addmodalvalues.php?id='.$row['VALUE_ID'].'&IDNO='.$row['IDNO'].'&vid='.$row['V_ID'].'" data-toggle="lightbox" >  <span class="fa fa-plus fw-fa"></span> Add Score</a></td>';
							echo "</tr>";	
							
						}
						?>
					</tbody>
					</form>
					<form action="printgrades.php" method="POST" target="_blank">
                <input type="hidden" name="stud_id" value="<?php echo $_GET['id']; ?>">
                <!-- this row will not appear when printing -->
                    <div class="row no-print">
                      <div class="col-xs-12">
					  <td></td>
					
                    </div>
                    </div> 
                  </form> 
				  	<td colspan="5">	
						<a href="form.php?id=<?php echo $IDNO?>" target="_blank"><button type="button" class="btn btn-primary btn-lg"><i class="fa fa-print"></i> Print</button></a>
					</td>
				</table>
			</div>
	

</div> <!---End of container-->