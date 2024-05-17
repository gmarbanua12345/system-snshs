<?php  
require_once("../../include/initialize.php");
     if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

  @$SUBJ_ID = $_GET['id'];
    if($SUBJ_ID==''){
  redirect("index.php");
}
if($_GET['IDNO']==''){
    redirect("index.php");
}

if($_GET['gid']==''){
    redirect("index.php");
}


  $subject = New Subject();
  $res = $subject->single_subject($SUBJ_ID);


  $grades = New Grade();
  $resgrades = $grades->single_grade($_GET['gid']);

?> 
<table>
    <tr>
       <td width="87%" align="center">
         <h3>Add Grades 
        </h3>
        </td>
    </tr>
</table>
 <form class="form-horizontal span6 ekko-lightbox-container" action="<?php echo web_root.'admin/student/'; ?>controller.php?action=addgrade" method="POST">
 
      
                    
<input class="form-control input-sm" id="IDNO" name="IDNO" placeholder=
"Account Id" type="Hidden" value="<?php echo $_GET['IDNO']; ?>">

<input class="form-control input-sm" id="SUBJ_ID" name="SUBJ_ID" placeholder=
"Account Id" type="Hidden" value="<?php echo $res->SUBJ_ID; ?>">

<input class="form-control input-sm" id="GRADEID" name="GRADEID" placeholder=
"Account Id" type="Hidden" value="<?php echo $_GET['gid']; ?>">
                 
       <div class="form-group">
        <div class="col-md-12">
          <label class="col-md-4 control-label" for=
          "SUBJ_CODE">Subject:</label>

          <div class="col-md-6">
            <textarea  class="form-control input-sm" id="SUBJ_CODE" name="SUBJ_CODE" readonly="true" rows="4" cols="32"><?php echo $res->SUBJ_CODE .'['. $res->SUBJ_DESCRIPTION.']';?></textarea>
             <!-- <input class="form-control input-sm" id="SUBJ_CODE" name="SUBJ_CODE" readonly="true" type="text" value="<?php echo $res->SUBJ_CODE .'['. $res->SUBJ_DESCRIPTION.']';?>"> -->
          </div>
        </div>
      </div>
      
        
      <div class="form-group">
        <div class="col-md-12">
          <label class="col-md-4 control-label" for=
          "FIRSTGRADING">First Grading:</label>

          <div class="col-md-6">
            
             <!--<input class="form-control input-sm" id="FIRSTGRADING" name="FIRSTGRADING" placeholder=
                "First Grading" type="text" value="<?php echo $resgrades->FIRST; ?>" autocomplete="off"  required>-->
                <select class="form-control input-sm" id="FIRSTGRADING" name="FIRSTGRADING" required>
                  <?php
                  for ($grade = 75; $grade <= 100; $grade++) {
                      $selected = ($grade == $resgrades->FIRST) ? 'selected' : '';
                      echo "<option value=\"$grade\" $selected>$grade</option>";
                  }
                  ?>
                </select>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12">
          <label class="col-md-4 control-label" for=
          "SECONDGRADING">Second Grading:</label>

          <div class="col-md-6">
            
                <!--<input class="form-control input-sm" id="SECONDGRADING" name="SECONDGRADING" placeholder=
                "Second Grading" type="text" value="<?php echo $resgrades->SECOND; ?>" autocomplete="off" required>-->
                <select class="form-control input-sm" id="SECONDGRADING" name="SECONDGRADING" required>
                  <?php
                  for ($grade = 75; $grade <= 100; $grade++) {
                      $selected = ($grade == $resgrades->SECOND) ? 'selected' : '';
                      echo "<option value=\"$grade\" $selected>$grade</option>";
                  }
                  ?>
                </select>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12">
          <label class="col-md-4 control-label" for=
          "THIRDGRADING">Third Grading:</label>

          <div class="col-md-6">
            
                <!--<input class="form-control input-sm" id="THIRDGRADING" name="THIRDGRADING" placeholder=
                "Third Grading" type="text" value="<?php echo $resgrades->THIRD ?>" autocomplete="off" required>-->
                <select class="form-control input-sm" id="THIRDGRADING" name="THIRDGRADING" required>
                  <?php
                  for ($grade = 75; $grade <= 100; $grade++) {
                      $selected = ($grade == $resgrades->THIRD) ? 'selected' : '';
                      echo "<option value=\"$grade\" $selected>$grade</option>";
                  }
                  ?>
                </select>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12">
          <label class="col-md-4 control-label" for=
          "FOURTHGRADING">Fourth Grading:</label>

          <div class="col-md-6">
            
             <!--<input class="form-control input-sm" id="FOURTHGRADING" name="FOURTHGRADING" placeholder=
                "Fourth Grading" type="text" value="<?php echo $resgrades->FOURTH ?>" autocomplete="off" required>-->
                <select class="form-control input-sm" id="FOURTHGRADING" name="FOURTHGRADING" required>
                  <?php
                  for ($grade = 75; $grade <= 100; $grade++) {
                      $selected = ($grade == $resgrades->FOURTH) ? 'selected' : '';
                      echo "<option value=\"$grade\" $selected>$grade</option>";
                  }
                  ?>
                </select>
          </div>
        </div>
      </div>
       

      <div class="form-group">
        <div class="col-md-12">
          <label class="col-md-4 control-label" for=
          "AVERAGE">Average:</label>

          <div class="col-md-6">
            
             <input class="form-control input-sm" id="AVERAGE" name="AVERAGE" placeholder=
                "0" type="text" value="<?php echo $resgrades->AVE; ?>" readonly="true" required>
          </div>
        </div>
      </div>
       
      <div class="form-group">
        <div class="col-md-12">
          <label class="col-md-4 control-label" for=
          "idno"></label>

          <div class="col-md-6">
           <button class="btn btn-primary btn-sm" name="save" type="submit" ><span class="fa fa-save fw-fa"></span>  Save</button> 
              <!-- <a href="index.php?view=grades&id=<?php echo $_GET['IDNO']; ?>" class="btn btn-info"><span class="fa fa-arrow-circle-left fw-fa"></span></span>&nbsp;<strong>Back</strong></a> -->
           </div>
        </div>
      </div>

          
        </form>
      
<script src="<?php echo web_root; ?>admin/jquery/jquery.min.js"></script>
<script type="text/javascript">
$("#FIRSTGRADING, #SECONDGRADING, #THIRDGRADING, #FOURTHGRADING").change(function() {
    var first = document.getElementById('FIRSTGRADING').value;
    var second = document.getElementById('SECONDGRADING').value;
    var third = document.getElementById('THIRDGRADING').value;
    var fourth = document.getElementById('FOURTHGRADING').value;
    var tot;

    first = parseFloat(first) * 0.20;
    second = parseFloat(second) * 0.20;
    third = parseFloat(third) * 0.20;
    fourth = parseFloat(fourth) * 0.40;

    tot = first + second + third + fourth;

    document.getElementById('AVERAGE').value = tot.toFixed(2);
});
</script>