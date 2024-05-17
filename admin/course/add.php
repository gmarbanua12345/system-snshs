                      <?php 
                       if (!isset($_SESSION['ACCOUNT_ID'])){
                          redirect(web_root."admin/index.php");
                         }

                      // $autonum = New Autonumber();
                      // $res = $autonum->single_autonumber(2);

                       ?> 
 <form class="form-horizontal span6" action="controller.php?action=add" method="POST">

           <div class="row">
         <div class="col-lg-12">
            <h1 class="page-header">Add Secondary Education</h1>
          </div>
          <!-- /.col-lg-12 -->
       </div> 
                   
                   <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "COURSE_NAME">Secondary Education Type:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" value="">
                            <select class="form-control input-sm" id="COURSE_NAME" name="COURSE_NAME" required>
                                <option value="">-- Please Select --</option>
                                <option value="JHS">Junior High School (Grades 7-10)</option>
                                <option value="SHS">Senior High School (Grades 11-12)</option>
                            </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "COURSE_LEVEL">Grade Level:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" value="">
                          <select class="form-control input-sm" id="COURSE_LEVEL" name="COURSE_LEVEL" required>
                              <option value="">-- Please Select --</option>
                              <option value="7">Grade 7</option>
                              <option value="8">Grade 8</option>
                              <option value="9">Grade 9</option>
                              <option value="10">Grade 10</option>
                              <option value="11">Grade 11</option>
                              <option value="12">Grade 12</option>
                          </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "COURSE_MAJOR">Strand:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" value="">
                            <select class="form-control input-sm" id="COURSE_MAJOR" name="COURSE_MAJOR" required>
                              <option value="N/A">N/A</option>
                              <option value="STEM">STEM (Science, Technology, Engineering, and Mathematics)</option>
                              <option value="ABM">ABM (Accountancy, Business, and Management)</option>
                              <option value="HUMSS">HUMSS (Humanities and Social Sciences)</option>
                              <option value="GAS">GAS (General Academic Strand)</option>
                          </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "COURSE_DESC">Description:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" value="">
                         <input class="form-control input-sm" id="COURSE_DESC" name="COURSE_DESC" placeholder=
                            "Grade Description" type="text" value="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "DEPT_ID">Department:</label>

                      <div class="col-md-8">
                       <select class="form-control input-sm" name="DEPT_ID" id="DEPT_ID" required>
                       <option value="" >Select</option>
                          <?php
                            $mydb->setQuery("SELECT * FROM `department`");
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
                       <button class="btn btn-primary btn-sm" name="save" type="submit" ><span class="fa fa-save fw-fa"></span>  Save</button> 
                          <!-- <a href="index.php" class="btn btn-info"><span class="fa fa-arrow-circle-left fw-fa"></span></span>&nbsp;<strong>List of Users</strong></a> -->
                       </div>
                    </div>
                  </div>

    
          
        </form>
       