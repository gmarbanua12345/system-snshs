<?php  
     if (!isset($_SESSION['IDNO'])){
      redirect(web_root."index.php");
     }
 
  $student = New Student();
  $res = $student->single_student($_SESSION['IDNO']);
  $IDNO = $_SESSION['IDNO'];
  
?>
 
<div class="row">
      <div class="col-lg-12"> 
            <h3 class="page-header">Student Subjects </h3>
       	 
       		</div>
        	<!-- /.col-lg-12 -->
   		 	    <form action="controller.php?action=delete" Method="POST">  
			      <div class="table-responsive">			
				<table id="example" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
				
				  <thead>
				  	<tr>
				  	<th>#</th>
				  		 <th>
				  		  Subject</th>
				  		<th>Description</th> 
				  		<th>Average</th>
				  		<th>Remarks</th>
				 
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
				  		echo '<td></td>';
				  		echo '<td>'. $result->SUBJ_CODE.'</td>';
				  		echo '<td>'. $result->SUBJ_DESCRIPTION.'</td>'; 
				  		echo '<td>'. $result->AVE.'</td>'; 
				  		echo '<td>'. $result->REMARKS.'</td>'; 
				  		//echo '<td> Grade '. $result->COURSE_LEVEL.'</td>'; 
				  	
				  		 
				  		// echo '<td align="center" > <a title="Edit" href="index.php?view=edit&id='.$result->SUBJ_ID.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
				  		// 			 <a title="Delete" href="controller.php?action=delete&id='.$result->SUBJ_ID.'" class="btn btn-danger btn-xs" ><span class="fa fa-trash-o fw-fa"></span> </a>
				  		// 			 </td>';
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

						$mydb->setQuery($sql);
						$val = $mydb->loadResultList();

						if (!empty($val)) {
							foreach ($val as $row) {
							echo "<tr>";
							echo '<td>'. $row->CORE_VALUE.'</td>';
							echo '<td>'. $row->STATEMENT1.'<br>'.$row->STATEMENT2.'</td>';
							echo '<td>'. $row->FIRST.'</td>';
							echo '<td>'. $row->SECOND.'</td>';
							echo '<td>'. $row->THIRD.'</td>';
							echo '<td>'. $row->FOURTH.'</td>';
				
							echo "</tr>";	
							}
						} else {
							echo "No results found."; // Or handle the lack of results appropriately
							
							//echo '<td align="center" > <a  title="Edit" href="addmodalgrades.php?id='.$result->SUBJ_ID.'&IDNO='.$result->IDNO.'&gid='.$result->GRADE_ID.'" data-toggle="lightbox" >  <span class="fa fa-plus fw-fa"></span> Add gardes</a></td>';echo '<td align="center" > <a  title="Edit" href="addmodalgrades.php?id='.$result->SUBJ_ID.'&IDNO='.$result->IDNO.'&gid='.$result->GRADE_ID.'" data-toggle="lightbox" >  <span class="fa fa-plus fw-fa"></span> Add gardes</a></td>';
						}
						?>
					</tbody>
				</table>
 
				<!-- <div class="btn-group">
				  <a href="index.php?view=add" class="btn btn-default">New</a>
				  <button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button>
				</div>
 -->
			</div>
		</form>
		<form action="student/printgrades.php" method="POST" target="_blank">
                <input type="hidden" name="IDNO" value="<?php echo $_SESSION['IDNO']; ?>">
                <!-- this row will not appear when printing -->
                    <div class="row no-print">
                      <div class="col-xs-12">
                       <span class="pull-right"> <button type="submit" name="submit" class="btn btn-primary"  ><i class="fa fa-print"></i> Print</button></span>  
                    </div>
                    </div> 
                  </form>  
	

</div> <!---End of container-->