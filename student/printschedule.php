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
    <h1  align="center">Schedules</h1>
    <hr/>
  </div>
                    <table  class="table table-striped table-bordered table-hover "  style="font-size:12px" cellspacing="0"  > 
                      <thead>
                        <tr> 
                          <th rowspan="2">#</th>
                          <th rowspan="2">Subject</th>  
                          <th rowspan="2">Description</th>
                          <th colspan="4">Schedule</th> 
                        </tr> 
                        <tr> 
                          <th>Day</th> 
                          <th>Time</th>
                          <th>Room</th> 
                          <th>Section</th>  
                          <th>Instructor</th> 
                        </tr>
                      </thead>   
                    <tbody>
                    <?php
                    $tot = 0;
                    // $sql ="SELECT * 
                    //       FROM  studentsubjects ss, `subject` sub, `tblschedule` s
                    //       WHERE  ss.`SUBJ_ID` = sub.`SUBJ_ID` AND sub.`SUBJ_ID` = s.`SUBJ_ID` AND OUTCOME !='Drop'  
                    //       AND ss.`IDNO`=" .$_SESSION['IDNO']."
                    //       AND s.sched_semester = '".$_SESSION['SEMESTER']."' AND LEVEL='".$_POST['Course']."'";
                    $mydb->setQuery("SELECT * FROM `subject` s, `course` c, `tblschedule` sc, `tblinstructor` i
                    WHERE s.COURSE_ID=c.COURSE_ID 
                    AND s.SUBJ_ID = sc.SUBJ_ID
                    AND i.INST_ID = sc.INST_ID
                    AND c.COURSE_ID = '".$stud->COURSE_ID."' ");

                      $cur = $mydb->loadResultList();

                      $n= 1;
                      foreach ($cur as $result) {
                        echo '<tr>'; 
                        echo '<td>'.$n.'</td>';
                        echo '<td>'.$result->SUBJ_CODE.'</td>'; 
                        echo '<td>'.$result->SUBJ_DESCRIPTION.'</td>';
                        echo '<td>'.$result->sched_day.'</td>';
                        echo '<td>'.$result->sched_time.'</td>';
                        echo '<td>'.$result->sched_room.'</td>';
                        echo '<td>'.$result->SECTION.'</td>';
                        echo '<td>'.$result->INST_NAME .'</td>';
                      
                        echo '</tr>';
                        $n++;
                        $tot += $result->UNIT;
                      }
                    ?> 
                    </tbody>
                      
                    </table>
                      
  </body>
</html>