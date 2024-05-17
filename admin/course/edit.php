<?php  
     if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

  @$COURSE_ID = $_GET['id'];
    if($COURSE_ID==''){
  redirect("index.php");
}
  $course = New Course();
  $singlecourse = $course->single_course($COURSE_ID);

?> 

 <form class="form-horizontal span6" action="controller.php?action=edit" method="POST">

           <div class="row">
         <div class="col-lg-12">
            <h1 class="page-header">Update Course/Year</h1>
          </div>
          <!-- /.col-lg-12 -->
       </div> 
      
                        
                         <input class="form-control input-sm" id="COURSE_ID" name="COURSE_ID" placeholder=
                            "Account Id" type="Hidden" value="<?php echo $singlecourse->COURSE_ID; ?>">
                    
                    <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "COURSE_NAME">Secondary Education Type:</label>

                      <div class="col-md-8">
                          <select class="form-control input-sm" id="COURSE_NAME" name="COURSE_NAME" required>
                            <option value="JHS" <?php if($singlecourse->COURSE_NAME == 'JHS') echo 'selected'; ?>>Junior High School (Grades 7-10)</option>
                            <option value="SHS" <?php if($singlecourse->COURSE_NAME == 'SHS') echo 'selected'; ?>>Senior High School (Grades 11-12)</option>
                          </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "COURSE_LEVEL">Grade Level:</label>

                      <div class="col-md-8">
                            <select class="form-control input-sm" id="COURSE_LEVEL" name="COURSE_LEVEL" required>
                              <option value="7" <?php if($singlecourse->COURSE_LEVEL == '7') echo 'selected'; ?>>Grade 7</option>
                              <option value="8" <?php if($singlecourse->COURSE_LEVEL == '8') echo 'selected'; ?>>Grade 8</option>
                              <option value="9" <?php if($singlecourse->COURSE_LEVEL == '9') echo 'selected'; ?>>Grade 9</option>
                              <option value="10" <?php if($singlecourse->COURSE_LEVEL == '10') echo 'selected'; ?>>Grade 10</option>
                              <option value="11" <?php if($singlecourse->COURSE_LEVEL == '11') echo 'selected'; ?>>Grade 11</option>
                              <option value="12" <?php if($singlecourse->COURSE_LEVEL == '12') echo 'selected'; ?>>Grade 12</option>
                          </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "COURSE_MAJOR">Major:</label>

                      <div class="col-md-8">
                            <select class="form-control input-sm" id="COURSE_MAJOR" name="COURSE_MAJOR" required>
                              <option value="N/A" <?php if($singlecourse->COURSE_MAJOR == 'N/A') echo 'selected'; ?>>N/A</option>
                              <option value="STEM" <?php if($singlecourse->COURSE_MAJOR == 'STEM') echo 'selected'; ?>>STEM (Science, Technology, Engineering, and Mathematics)</option>
                              <option value="HUMSS" <?php if($singlecourse->COURSE_MAJOR == 'HUMS') echo 'selected'; ?>>HUMSS (Humanities and Social Sciences)</option>
                              
                          </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "COURSE_DESC">Description:</label>

                      <div class="col-md-8">
                        
                         <input class="form-control input-sm" id="COURSE_DESC" name="COURSE_DESC" placeholder=
                            "Course Description" type="text" value="<?php echo $singlecourse->COURSE_DESC; ?>">
                      </div>
                    </div>
                  </div>
                 

                 <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "DEPT_ID">Department:</label>

                      <div class="col-md-8">
                       <select class="form-control input-sm" name="DEPT_ID" id="DEPT_ID"> 
                          <?php 

                            $mydb->setQuery("SELECT * FROM `department` WHERE DEPT_ID=". $singlecourse->DEPT_ID);
                            $cur = $mydb->loadResultList();

                            foreach ($cur as $result) {
                              echo '<option value='.$result->DEPT_ID.' >'.$result->DEPARTMENT_NAME.' [ '.$result->DEPARTMENT_DESC .' ]</option>';

                            }
                          ?> 
                          <?php 

                            $mydb->setQuery("SELECT * FROM `department` WHERE DEPT_ID!=". $singlecourse->DEPT_ID);
                            $cur = $mydb->loadResultList();

                            foreach ($cur as $result) {
                              echo '<option value='.$result->DEPT_ID.' >'.$result->DEPARTMENT_NAME.' [ '.$result->DEPARTMENT_DESC .' ]</option>';

                            }
                          ?>

                         
                        </select> 
                      </div>
                    </div>
                  </div>
             <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "idno"></label>

                      <div class="col-md-8">
                         <button class="btn btn-primary " name="save" type="submit" ><span class="fa fa-save fw-fa"></span> Save</button>
                        </div>
                    </div>
                  </div>

              
             <div class="form-group">
                <div class="rows">
                  <div class="col-md-6">
                    <label class="col-md-6 control-label" for=
                    "otherperson"></label>

                    <div class="col-md-6">
                   
                    </div>
                  </div>

                  <div class="col-md-6" align="right">
                   

                   </div>
                  
              </div>
              </div>
          
        </form>
      

        </div><!--End of container-->