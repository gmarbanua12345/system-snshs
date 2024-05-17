<?php  
 if (!isset($_SESSION['IDNO'])){
      redirect("index.php");
     }


    $student = New Student();
    $res = $student->single_student($_SESSION['IDNO']);

    $course = New Course();
    $resCourse = $course->single_course($res->COURSE_ID);
	?>
    
  <style type="text/css">
  #img_profile{
    width: 100%;
    height:auto;
  }
    #img_profile >  a > img {
    width: 100%;
    height:auto;
}


  </style>
  		<div class="col-sm-3">
 
          <div class="panel">            
            <div id="img_profile" class="panel-body">
            <a href="" data-target="#myModal" data-toggle="modal" >
            <img title="profile image" class="img-hover"   src="<?php echo web_root. 'student/'.  $res->STUDPHOTO; ?>">
            </a>
             </div>
          <ul class="list-group  ">
               <li class="list-group-item text-right"><span class="pull-left"><strong>Real name</strong></span> <?php echo $res->FNAME .' '.$res->LNAME; ?> </li>
              <li class="list-group-item text-right"><span class="pull-left"><strong>Strand/Grade Level</strong></span> <?php
if (empty($resCourse)) {
    echo "Account not yet confirmed";
} else {
    echo $resCourse->COURSE_NAME . ' - Grade ' . $resCourse->COURSE_LEVEL;
}
?> </li>
               <li class="list-group-item text-right"><span class="pull-left"><strong>Status</strong></span> <?php echo $res->student_status; ?> </li>
               
            
          </ul> 
                
        </div>
    </div>
         
        <!--/col-3-->
<div class="col-sm-9"> 

<div class="panel">            
  <div class="panel-body">
   <?php
       check_message();   
       ?>
  <ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#home" data-toggle="tab">List of Subjects</a></li> 
    <li><a href="#grades" data-toggle="tab">Grades</a></li>
    <?php 
    if ($res->student_status=='Irregular' || $res->student_status=='Transferee' && $res->NewEnrollees==0) {
      # code... 
    ?>
    <li><a href="#adddrop" data-toggle="tab">Adding and Dropping</a></li>
    <?php 
    }
    ?>
    <li><a href="#settings" data-toggle="tab">Update Account</a></li>
  </ul>
              
  <div class="tab-content">
    <div class="tab-pane active" id="home">
    <br/>
    <div class="col-md-12">
     <h3>Enrolled Subjects</h3> 
    </div>
      <div class="table-responsive" style="margin-top:5%;"> 
             <form action="customer/controller.php?action=delete" Method="POST">  					
            				<table  class="table table-striped table-bordered table-hover "  style="font-size:12px" cellspacing="0"  > 
            				  <thead>
            				  	<tr> 
                          <th rowspan="2">Subject</th>
                          <th rowspan="2">Description</th>  
                          <th rowspan="2">Unit</th>
                          <th colspan="4">Schedule</th> 
            				  	</tr>	
                        <tr> 
                          <th>Day</th> 
                          <th>Time</th>
                          <th>Room</th> 
                        </tr>
            				  </thead> 	 
            			  <tbody>
                    <?php
             

                    $latestYear = "SELECT MAX(SY) as max_year 
                    FROM studentsubjects 
                    INNER JOIN tblstudent ON tblstudent.IDNO = studentsubjects.IDNO 
                    WHERE studentsubjects.IDNO = '" . $_SESSION['IDNO'] . "'";
                    $yearQuery = mysqli_query($mydb->conn,$latestYear) or die(mysqli_error($mydb->conn));
                    $yearRes = mysqli_fetch_assoc($yearQuery);

                    $mydb->setQuery("SELECT * FROM  `studentsubjects`
                 INNER JOIN subject ON subject.SUBJ_ID = studentsubjects.SUBJ_ID
                 INNER JOIN tblschedule ON subject.SUBJ_ID = tblschedule.SUBJ_ID
                 WHERE studentsubjects.IDNO = '".$_SESSION['IDNO']."'
                 AND studentsubjects.SY = '".$yearRes['max_year']."'");

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
                        echo '</tr>';
                        $n++;
                      }
                    ?> 
            				</tbody>
            					<!-- <footer>
                        <tr>
                          <td colspan="7"><a class="btn btn-primary btn-sm" href="">Print</a></td>
                        </tr>     
                      </footer> -->
            				 	
            				</table>
                     
            		 </form>
                  <form action="student/printschedule.php" method="POST" target="_blank">
            
                <!-- this row will not appear when printing -->
                    <?php 
                    if (!empty($resCourse)) {
                      ?>
                    <div class="row no-print">
                      <div class="col-xs-12">
                       <span class="pull-right"> <button type="submit" name="submit" class="btn btn-primary"  ><i class="fa fa-print"></i> Print</button></span>  
                    </div>
                  
                    </div> 
                    <?php } ?>
                  </form>       
         
              </div><!--/table-resp-->
               
             </div><!--/tab-pane-->
            <div class="tab-pane" id="grades">
         
              <?php require_once  ("studentgrades.php"); ?>
          
       
            </div>
             <div class="tab-pane" id="adddrop">
         
              
              <?php //require_once  ("changingdropping.php"); ?>
          
       
            </div>
             <div class="tab-pane" id="settings">
    		 
              <?php require_once  ("updateyearlevel.php"); ?>
          
       
            </div><!--/tab-pane-->
  </div><!--/tab-content-->
 </div>
</div><!--/col-9--> 
</div>




	  <!-- Modal photo -->
          <div class="modal fade" id="myModal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal" type=
                  "button">×</button>

                  <h4 class="modal-title" id="myModalLabel">Choose Image.</h4>
                </div>

                <form action="student/controller.php?action=photos" enctype="multipart/form-data" method=
                "post">
                  <div class="modal-body">
                    <div class="form-group">
                      <div class="rows">
                        <div class="col-md-12">
                          <div class="rows">
                            <div class="col-md-8">
                              <input name="MAX_FILE_SIZE" type=
                              "hidden" value="1000000"> <input id=
                              "photo" name="photo" type=
                              "file">
                            </div>

                            <div class="col-md-4"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type=
                    "button">Close</button> <button class="btn btn-primary"
                    name="savephoto" type="submit">Upload Photo</button>
                  </div>
                </form>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
   