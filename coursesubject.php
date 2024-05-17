<?php

if (isset($_POST['save'])) {

  
  $sql = "UPDATE tblstudent SET 
      ENROLL_LEVEL = '{$_POST['course_id']}',
      ENROLL_YEAR = '{$_POST['school_year']}'
       WHERE IDNO = " . $_POST['IDNO'];

  $updateQuery = mysqli_query($mydb->conn, $sql) or die(mysqli_error($mydb->conn));
}


?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
 <!-- Main content -->
 <?php   //check_message();  ?> 
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h3 class="page-header">
            <i class="fa fa-user"></i> Student Information
            <small class="pull-right">Date: <?php echo date('m/d/Y'); ?></small>
          </h3>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
      <?php
      if (isset($_POST['save'])) {
        if ($updateQuery) {
            echo '<div class="alert alert-success" role="alert">Enrollment submitted successful. Please wait for confirmation of the administrator!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Update failed: ' . mysqli_error($mydb->conn) . '</div>';
        }
      }
        ?>
        <div class="col-sm-8 invoice-col"> 
          <address>
            <?php
            $stud = New Student();
            $singleStud = $stud->single_student($_SESSION['IDNO']);
            $currentYear = date('Y');
            $nextYear =  date('Y') + 1;
            $sy = $currentYear .'-'.$nextYear;
            $_SESSION['SY'] = $sy; 

            $startYear = $currentYear - 5;
            $endYear = $nextYear + 3;

            $latestGrade = "SELECT MAX(AY) as school_year, MAX(COURSE_LEVEL) as course_level FROM schoolyr INNER JOIN course ON course.COURSE_ID = schoolyr.COURSE_ID WHERE IDNO =" .$singleStud->IDNO;
            $gradeQuery = mysqli_query($mydb->conn,$latestGrade) or die(mysqli_error($mydb->conn));
            $levelRes = mysqli_fetch_assoc($gradeQuery);
            ?>
            <b>Name : <?php echo $singleStud->LNAME. ', ' .$singleStud->FNAME .' ' .$singleStud->EXT .' ' .$singleStud->MNAME;?></b><br>
            Grade Level : <b>Grade <?php echo $levelRes['course_level'];?></b><br> 
            School Year : <b><?php echo $levelRes['school_year'];?></b><br> 
            
          </address>
          <table id="example" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
            <thead>
              <th>#</th>
              <th>SUBJECT</th>
              <th>DESCRIPTION</th>
              <th>REMARKS</th>
            </thead>
            <tbody>
          <?php
          $gradesQuery = "SELECT * FROM studentsubjects INNER JOIN subject ON subject.SUBJ_ID = studentsubjects.SUBJ_ID WHERE IDNO =" .$singleStud->IDNO . " AND studentsubjects.SY = '" . $levelRes['school_year']. "'";
          $gradeQuery = mysqli_query($mydb->conn,$gradesQuery) or die(mysqli_error($mydb->conn));
          $n = 1;
          $failed = 0;
          while ($row = mysqli_fetch_array($gradeQuery)) {
            if($row['OUTCOME'] != "Passed"){
              $failed = 1;
            }
            echo "<tr>";
            echo "<td>".$n."</td>";
            echo "<td>".$row['SUBJ_CODE']."</td>";
            echo "<td>".$row['SUBJ_DESCRIPTION']."</td>";
            echo "<td>".$row['OUTCOME']."</td>";
            echo "</tr>";
            $n++;
          }
          ?>
            </tbody>
          </table>
          <form action="" method="POST">
            
          <?php
          $nextLevel = $levelRes['course_level'] + 1;
          $parts = explode("-", $levelRes['school_year']);
          $startYear = intval($parts[0]); 
          $endYear = intval($parts[1]);

          $newStartYear = $startYear + 1; 
          $newEndYear = $endYear + 1; 

          $newLevel = $newStartYear . "-" . $newEndYear;
          if($failed == 0){
            

            if($nextLevel > 10){
              $nextGrade = "SELECT * FROM course WHERE COURSE_LEVEL =" .$nextLevel;
              $nextGradeQuery = mysqli_query($mydb->conn,$nextGrade) or die(mysqli_error($mydb->conn));
              $n = 1;
              $failed = 0;
              while ($row = mysqli_fetch_array($nextGradeQuery)) {
                echo '<select class="form-control" name="course_id">';
                echo '<option value="'.$row['COURSE_ID'].'">Grade '.$row['COURSE_LEVEL'].' - '.$row['COURSE_MAJOR'].'</option>';
                echo '</select>';
              }
            }else{
              $nextGrade = "SELECT * FROM course WHERE COURSE_LEVEL =" .$nextLevel;
              $nextGradeQuery = mysqli_query($mydb->conn,$nextGrade) or die(mysqli_error($mydb->conn));
              $nextGradeRes = mysqli_fetch_assoc($nextGradeQuery);

              echo '<input type="hidden" name="school_year" id="school_year" value="'. $newLevel .'">
              <input type="hidden" name="course_id" id="course_id" value="' .$nextGradeRes['COURSE_ID']. '">';
              echo "<b>You are eligible to enroll Grade ".$nextLevel." for school year ".$newLevel.".<br>";
              echo '<button class="btn btn-success btn-lg" name="save" type="submit"><span class="fa fa-save fw-fa"> Click here to Enroll</span></button>';
            }
            
          }else if($failed == 1){
            echo "<b>You have incomplete or failed grade/s. You are not eligible to enroll Grade ".$nextLevel." for school year ".$newLevel.".";
          }
          ?>
            <input type="hidden" name="IDNO" id="IDNO" value="<?php echo $singleStud->IDNO; ?>">
            
          </form>
        </div>
      </div>
</div>

