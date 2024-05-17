<?php 
require_once ("../include/initialize.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>SNHS Balugo Extension Enrollment System </title>

     <!-- Bootstrap Core CSS -->
 <link href="<?php echo web_root; ?>css/bootstrap.min.css" rel="stylesheet">
 
    <!-- Custom Fonts -->
    <link href="<?php echo web_root; ?>font/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <link href="<?php echo web_root; ?>font/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- DataTables CSS -->
    <link href="<?php echo web_root; ?>css/dataTables.bootstrap.css" rel="stylesheet">
 
     <!-- datetime picker CSS -->
<link href="<?php echo web_root; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
 
 <link href="<?php echo web_root; ?>css/modern.css" rel="stylesheet">
 <link href="<?php echo web_root; ?>css/costum.css" rel="stylesheet">
  <body onload="window.print();">

  <div class="row">
        <div class="col-xs-12">
          <h4 class="page-header">
            <i class="fa fa-user"></i> Student Information
            <small class="pull-right">Date: <?php echo date('m/d/Y'); ?></small>
          </h4>
        </div>
        <!-- /.col -->
      </div> 
      <?php
      $sem = new Semester();
      $resSem = $sem->single_semester();
      $_SESSION['SEMESTER'] = $resSem->SEMESTER; 


      $currentyear = date('Y');
      $nextyear =  date('Y') + 1;
      $sy = $currentyear .'-'.$nextyear;
      $_SESSION['SY'] = $sy;

	$IDNO = $_SESSION['IDNO'];
      $student = New Student();
      $stud = $student->single_student($_SESSION['IDNO']);

      ?>
      <table>
        <tr>
          <td width="75%" colspan="2" >
            <address>
            <b>Name : <?php echo $stud->LNAME. ', ' .$stud->FNAME .' ' .$stud->MNAME;?></b><br>
            Address : <?php echo $stud->CURRENT_ADD;?><br> 
            
          </address>
          </td>
          <td >
             <b>Course/Year:  <?php 

            $course = New Course();
            $singlecourse = $course->single_course($stud->COURSE_ID);
            echo $_SESSION['COURSE_YEAR'] = $singlecourse->COURSE_NAME.' - Grade '.$singlecourse->COURSE_LEVEL;
            $_SESSION['COURSEID'] =$stud->COURSE_ID;
            $_SESSION['COURSELEVEL'] = $stud->YEARLEVEL;
            ?></b><br>
          <b>Semester : <?php echo $_SESSION['SEMESTER']; ?></b> <br/>
          <b>Academic Year : <?php echo $_SESSION['SY']; ?></b>
          </td>
        </tr>
      </table>

  <div class="row">
    <h1  align="center">Grades</h1>
    <hr/>
  </div>
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

						$sql = "SELECT st.IDNO, g.SUBJ_ID, s.SUBJ_CODE, s.SUBJ_DESCRIPTION, g.AVE, g.REMARKS
        FROM tblstudent st
        INNER JOIN grades g ON st.IDNO = g.IDNO
        INNER JOIN subject s ON g.SUBJ_ID = s.SUBJ_ID
        INNER JOIN studentsubjects ss ON g.IDNO = ss.IDNO AND g.SUBJ_ID = ss.SUBJ_ID
        WHERE st.IDNO = ".$IDNO." 
        AND ss.SY = '".$yearRes['max_year']."'";
		$mydb->setQuery($sql);

				  		$cur = $mydb->loadResultList();
						$n = 1;
						foreach ($cur as $result) {

				  		echo '<tr>';
				  		// echo '<td width="5%" align="center"></td>';
				  		echo '<td>'.$n.'</td>';
				  		echo '<td>'. $result->SUBJ_CODE.'</td>';
				  		echo '<td>'. $result->SUBJ_DESCRIPTION.'</td>'; 
				  		echo '<td>'. $result->AVE.'</td>'; 
				  		echo '<td>'. $result->REMARKS.'</td>'; 
				  		//echo '<td>'. $Level.'</td>'; 
				  	$n++;
				  		 
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
                      
  </body>
</html>