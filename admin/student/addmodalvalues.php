<?php  
require_once("../../include/initialize.php");
    if (!isset($_SESSION['ACCOUNT_ID'])){
        redirect(web_root."admin/index.php");
    }

@$VALUE_ID = $_GET['id'];
    if($VALUE_ID==''){
        redirect("index.php");
    }

    if($_GET['IDNO']==''){
        redirect("index.php");
    }

    if($_GET['vid']==''){
        redirect("index.php");
    }


    $query = "SELECT * FROM `tblvalues` WHERE `VALUE_ID`=".$VALUE_ID;
	$result = mysqli_query($mydb->conn,$query) or die(mysqli_error($mydb->conn));
	$row = mysqli_fetch_object($result); 

    if ($row) {
        $core_value = $row->CORE_VALUE;
        $statement1 = $row->STATEMENT1;
        $statement2 = $row->STATEMENT2;
    } else {
        echo "No data found."; 
    }

    $query = "SELECT * FROM `corevalues` WHERE `V_ID`=".$_GET['vid'];
	$result = mysqli_query($mydb->conn,$query) or die(mysqli_error($mydb->conn));
	$row = mysqli_fetch_object($result); 

    if ($row) {
        $FIRST = $row->FIRST;
        $SECOND = $row->SECOND;
        $THIRD = $row->THIRD;
        $FOURTH = $row->FOURTH;
    } else {
        echo "No data found."; 
    }

?> 
<table>
    <tr>
        <td width="87%" align="center">
            <h3>Add Values 
        </h3>
        </td>
    </tr>
</table>
<form class="form-horizontal span6 ekko-lightbox-container" action="<?php echo web_root.'admin/student/'; ?>controller.php?action=addvalue" method="POST">

<input class="form-control input-sm" id="IDNO" name="IDNO" placeholder=
"Account Id" type="Hidden" value="<?php echo $_GET['IDNO']; ?>">

<input class="form-control input-sm" id="VALUE_ID" name="VALUE_ID" placeholder=
"Account Id" type="Hidden" value="<?php echo $VALUE_ID; ?>">

<input class="form-control input-sm" id="V_ID" name="V_ID" placeholder=
"Account Id" type="Hidden" value="<?php echo $_GET['vid']; ?>">

<div class="form-group">
    <div class="col-md-12">
        <label class="col-md-4 control-label" for="CORE_VALUE">Core Value:</label>
        <div class="col-md-6">
            <input class="form-control input-sm" id="CORE_VALUE" name="CORE_VALUE" placeholder="CORE_VALUE" type="text" value="<?php echo $core_value; ?>" autocomplete="off" readonly="true">
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        <label class="col-md-4 control-label" for="STATEMENT1">Behavior Statements</label>
        <div class="col-md-6">
            <textarea  class="form-control input-sm" id="STATEMENT1" name="STATEMENT1" readonly="true" rows="2" cols="32"><?php echo $statement1;?></textarea><br>
            <textarea  class="form-control input-sm" id="STATEMENT2" name="STATEMENT2" readonly="true" rows="2" cols="32"><?php echo $statement2;?></textarea>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        <label class="col-md-4 control-label" for="FIRSTGRADING">First Grading:</label>
        <div class="col-md-6">
            <input class="form-control input-sm" id="FIRSTGRADING" name="FIRSTGRADING" placeholder="First Grading" type="text" value="<?php echo $FIRST; ?>" autocomplete="off"  required>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        <label class="col-md-4 control-label" for="SECONDGRADING">Second Grading:</label>
        <div class="col-md-6">
            <input class="form-control input-sm" id="SECONDGRADING" name="SECONDGRADING" placeholder="Second Grading" type="text" value="<?php echo $SECOND; ?>" autocomplete="off" required>
        </div>
    </div>
</div>

      <div class="form-group">
        <div class="col-md-12">
          <label class="col-md-4 control-label" for=
          "THIRDGRADING">Third Grading:</label>

          <div class="col-md-6">
            
             <input class="form-control input-sm" id="THIRDGRADING" name="THIRDGRADING" placeholder=
                "Third Grading" type="text" value="<?php echo $THIRD ?>" autocomplete="off" required>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12">
          <label class="col-md-4 control-label" for=
          "FOURTHGRADING">Fourth Grading:</label>

          <div class="col-md-6">
            
             <input class="form-control input-sm" id="FOURTHGRADING" name="FOURTHGRADING" placeholder=
                "Fourth Grading" type="text" value="<?php echo $FOURTH ?>" autocomplete="off" required>
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
    $("#FIRSTGRADING").keyup(function(){
        //alert('FIRSTGRADING');

   var first = document.getElementById('FIRSTGRADING').value;
   var second = document.getElementById('SECONDGRADING').value;
   var third = document.getElementById('THIRDGRADING').value;
   var fourth = document.getElementById('FOURTHGRADING').value;
   var tot;


    first = parseFloat(first) * .20;
    second = parseFloat(second) * .20;
    third = parseFloat(third) * .20;
    fourth = parseFloat(fourth) * .40

    tot = parseFloat(first) +  parseFloat(second)  +  parseFloat(third)  +  parseFloat(fourth) ;

    // tot = tot /  4;

   document.getElementById('AVERAGE').value = tot.toFixed(2);



    });
    $("#SECONDGRADING").keyup(function(){
      var first = document.getElementById('FIRSTGRADING').value;
   var second = document.getElementById('SECONDGRADING').value;
   var third = document.getElementById('THIRDGRADING').value;
   var fourth = document.getElementById('FOURTHGRADING').value;
   var tot;


    first = parseFloat(first) * .20;
    second = parseFloat(second) * .20;
    third = parseFloat(third) * .20;
    fourth = parseFloat(fourth) * .40

    tot = parseFloat(first) +  parseFloat(second)  +  parseFloat(third)  +  parseFloat(fourth) ;

    // tot = tot /  4;

   document.getElementById('AVERAGE').value = tot.toFixed(2);

    });
    $("#THIRDGRADING").keyup(function(){
        // alert('THIRDGRADING');
   var first = document.getElementById('FIRSTGRADING').value;
   var second = document.getElementById('SECONDGRADING').value;
   var third = document.getElementById('THIRDGRADING').value;
   var fourth = document.getElementById('FOURTHGRADING').value;
   var tot;


    first = parseFloat(first) * .20;
    second = parseFloat(second) * .20;
    third = parseFloat(third) * .20;
    fourth = parseFloat(fourth) * .40

    tot = parseFloat(first) +  parseFloat(second)  +  parseFloat(third)  +  parseFloat(fourth) ;

    // tot = tot /  4;

   document.getElementById('AVERAGE').value = tot.toFixed(2);

    });
    $("#FOURTHGRADING").keyup(function(){
        // alert('FOURTHGRADING');
 var first = document.getElementById('FIRSTGRADING').value;
   var second = document.getElementById('SECONDGRADING').value;
   var third = document.getElementById('THIRDGRADING').value;
   var fourth = document.getElementById('FOURTHGRADING').value;
   var tot;


    first = parseFloat(first) * .20;
    second = parseFloat(second) * .20;
    third = parseFloat(third) * .20;
    fourth = parseFloat(fourth) * .40

    tot = parseFloat(first) +  parseFloat(second)  +  parseFloat(third)  +  parseFloat(fourth) ;

    // tot = tot /  4;

   document.getElementById('AVERAGE').value = tot.toFixed(2);

    });



    $("input").click(function(){
        this.select();

    });
</script><?php  
