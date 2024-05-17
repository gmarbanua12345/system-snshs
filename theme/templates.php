<!DOCTYPE html>
<html lang="en">
<head>
  
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/query.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo $title; ?> | SNHS Balugo Extension Enrollment System </title>

     <!-- Bootstrap Core CSS -->
 <link href="<?php echo web_root; ?>css/bootstrap.min.css" rel="stylesheet">
 
    <!-- Custom Fonts -->
    <link href="<?php echo web_root; ?>font/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- <link href="<?php echo web_root; ?>font/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
    <!-- DataTables CSS -->
    <link href="<?php echo web_root; ?>css/dataTables.bootstrap.css" rel="stylesheet">
 
     <!-- datetime picker CSS -->
<link href="<?php echo web_root; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
 
 <link href="<?php echo web_root; ?>css/modern.css" rel="stylesheet">
 <link href="<?php echo web_root; ?>css/costum.css" rel="stylesheet">

  <link href="<?php echo web_root; ?>css/ekko-lightbox.css" rel="stylesheet">
 <style type="text/css">

body {
        padding-top: 0;
        padding-bottom: 50;
        margin: 0;
    }

    .navbar-fixed {
        position: fixed;
        top: 0;
        bottom:50;
        width: 100%;
        z-index: 1000;
    }
.p {

  color: white;
   margin-bottom: 0;
  margin-top: 0;
  /*padding: 0;*/
  /*float: right;*/
  list-style: none;
}

.p > a { 
  color: white;
  /*text-align: center;*/
  margin-bottom: 0;
  margin: 0;
  padding: 0;
  text-decoration:none;
  background-color:  #0000FF;
}
.p > a:hover ,
.p > a:focus {
   color: black; 
   text-decoration:none;
   background-color: #2d52f2;
}


 
.title-logo  {
    color:black;
    text-decoration:none;
    font-size: 42px;
    font-family: "broadway";
    /*font-style: bold;*/
    padding: 0;
    margin: 0;
    top: 0;
  
  }
.title-logo:hover {
  color: blue; 
  text-decoration:none; 
}
.carttxtactive {
  color: red;
  font-style: bold;
  box-shadow: red;

}
.carttxtactive:hover {
   color: white;
}

.menu  li {
  left: 0px;
  width: 150px;
  padding: 0 3px 0 3px;
  text-align: center;
 
}

footer {
            background-color: #178F9B !important;
            color: #F1F5F8 !important;
            padding: 20px 0 !important;
            text-align: center !important;
            font-size: 14px !important;
        }

        footer h1 {
            margin: 0 !important;
        }

</style>

<?php 
$sem = new Semester();
$resSem = $sem->single_semester();
$_SESSION['SEMESTER'] = $resSem->SEMESTER; 
?>
 <?php
if (isset($_SESSION['gvCart'])){
  if (count($_SESSION['gvCart'])>0) {
    $cart = '<span class="carttxtactive">('.count($_SESSION['gvCart']) .')</span>';
  } 
 
} 
$currentyear = date('Y');
  $nextyear =  date('Y') + 1;
  $sy = $currentyear .'-'.$nextyear;
  $_SESSION['SY'] = $sy;
 ?>
</head>

<div class="navbar-fixed navbar-TOPsm col-md-12" role="navigation" style="height: 50px;">
    <div class="container">
      <p> </p>

        <div class="collapse navbar-collapse smMenu">


            <ul class="navbar-nav p navbar-right">
                <?php
                if (isset($_SESSION['IDNO'])) {
                    $student = new Student();
                    $singlestudent = $student->single_student($_SESSION['IDNO']);
                    if ($singlestudent->student_status == 'Irregular') {
                        ?>
                        <li class="dropdown dropdown-toggle tooltip-demo">
                            <a data-toggle="tooltip" data-placement="bottom" title="Subject to be taken"
                               href="<?php echo web_root . 'index2.php?q=cart'; ?>">
                                <i class="fa fa-shopping-cart fa-fw"></i> <?php echo isset($cart) ? $cart : "(0)"; ?>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                    <li class="dropdown dropdown-toggle">
                        <a style="color: black;" class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <?php echo $singlestudent->FNAME . ' ' . $singlestudent->LNAME; ?>
                            <i class="caret"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-acnt">
                            <li><a title="Edit"
                                   href="<?php echo web_root; ?>index2.php?q=profile">My Profile</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="tooltip-demo">
                        <a style="color: black;" data-toggle="tooltip" data-placement="left" title="ENROLL NOW"
                           href="<?php echo web_root . '/admin'; ?>">
                          
                        </a>
                    </li>
                    <?php } ?>
            </ul>
        </div>

    </div>
</div>



 <!-- <div class="col-md-10 col-md-push-1 " style=" margin-top:-2%">  -->



    

<?php
  
  ?>

        <!--/.navbar-collapse --> 
    </div> 
   <!-- /.nav-collapse --> 
  </div> 
 <!-- /.container -->

<!-- pop up login -->
<?php // include "LogSignModal.php"; ?> 
<!-- end pop up login -->
  
<div class="col-md-12" style="overflow-y: scroll; overflow-x: hidden;"> 
   <!-- start content --> 
   
  <?php  check_message(); ?> 
  
        <div class="row " style="padding-top: 50px; > 
          <div id="page-wrapper">
               <?php

          if($title=='Profile'){
                echo ' <div class="row">';

                require_once $content;
                echo ' </div><br/>';
     
              }else{
  // check_message(); ?>


            <div class="row">
              <div class="col-lg-12">
                <div class="panel panel-default">
                <div class="panel-heading fixed-panel-heading" style="background-color:#40E0D0;color:#fff;
                             position: fixed; top: 0; left: 0; width: 100%; z-index: 1000;">
                  <b><?php   
                  echo  $title . (isset($_GET['category']) ?  '  |  ' .$_GET['category'] : '' )?> </b> 
                  </div>
                  <div class="panel-body" style="padding-top: 30px;">
                 
                    <?php require_once $content; ?>
           
                     
                  </div>
                  <!--   <div class="panel-footer">
                      Panel Footer
                  </div> -->
              </div>
          </div> 
          </div> 
        <?php }
        ?>
       </div>

       </div>
            <footer class="panel-footer" style="background-color:#40E0D0;color:#000000;" >
              <p align="center" >Ensures Quality Education
                        to the least, the last and the lost
                        while nurturing lifelong learners. </p>
              <p align="center" >&copy;SNHS Balugo Extension Enrollment System </p>
           </footer>
      </div>
   

  </div>  

   
    
<!-- end of page  -->


 <!-- modalorder -->
 <div class="modal fade" id="myOrdered">
 </div>
<!-- end -->
 
  <!-- jQuery -->
  <script src="<?php echo web_root; ?>jquery/jquery.min.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="<?php echo web_root; ?>js/bootstrap.min.js"></script>
  <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>input-mask/jquery.inputmask.js"></script> 
  <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>input-mask/jquery.inputmask.date.extensions.js"></script> 
  <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>input-mask/jquery.inputmask.extensions.js"></script> 

  <!-- Metis Menu Plugin JavaScript --> 
  <!-- DataTables JavaScript -->
  <script src="<?php echo web_root; ?>js/jquery.dataTables.min.js"></script>
  <script src="<?php echo web_root; ?>js/dataTables.bootstrap.min.js"></script>
  <script src="<?php echo web_root; ?>js/ekko-lightbox.js"></script>

  <script type="text/javascript" src="<?php echo web_root; ?>js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
  <script type="text/javascript" src="<?php echo web_root; ?>js/locales/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>

  <!-- Custom Theme JavaScript --> 
  <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>js/janobe.js"></script> 
<script>
      //Datemask2 mm/dd/yyyy
    

   
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    // popover demo
    $("[data-toggle=popover]")
        .popover()
    </script>


      <script>
        $('.carousel').carousel({
            interval: 5000 //changes the speed
        })
    </script>

<script type="text/javascript">


$('#date_picker').datetimepicker({
  format: 'mm/dd/yyyy',
    language:  'en',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
    });

 
 
 
function validatedate(){ 
 
 

    var todaysDate = new Date() ;

    var txtime =  document.getElementById('ftime').value
    // var myDate = new Date(dateme); 

    var tprice = document.getElementById('alltot').value 
    var pmethod = document.getElementById('paymethod').value
    var onum = document.getElementById('ORDERNUMBER').value

     
     var mytime = parseInt(txtime)  ;
     var todaytime =  todaysDate.getHours()  ;
       if (txtime==""){
     alert("You must set the time enable to submit the order.")
     }else 
     if (mytime<todaytime){ 
        alert("Selected time is invalid. Set another time.")
      }else{
        window.location = "index2.php?page=7&price="+tprice+"&time="+txtime+"&paymethod="+pmethod+"&ordernumber="+onum; 
      }
  }
</script>  


    <script type="text/javascript">
  $('.form_curdate').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
  $('.form_bdatess').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
</script>
<script>
 


  function checkall(selector)
  {
    if(document.getElementById('chkall').checked==true)
    {
      var chkelement=document.getElementsByName(selector);
      for(var i=0;i<chkelement.length;i++)
      {
        chkelement.item(i).checked=true;
      }
    }
    else
    {
      var chkelement=document.getElementsByName(selector);
      for(var i=0;i<chkelement.length;i++)
      {
        chkelement.item(i).checked=false;
      }
    }
  }
   function checkNumber(textBox){
        while (textBox.value.length > 0 && isNaN(textBox.value)) {
          textBox.value = textBox.value.substring(0, textBox.value.length - 1)
        }
        textBox.value = trim(textBox.value);
      }
      //
      function checkText(textBox)
      {
        var alphaExp = /^[a-zA-Z]+$/;
        while (textBox.value.length > 0 && !textBox.value.match(alphaExp)) {
          textBox.value = textBox.value.substring(0, textBox.value.length - 1)
        }
        textBox.value = trim(textBox.value);
      }
  

       
  </script>     
 <!-- method for saving and retrieving data without refreshing the page. -->
<script type="text/javascript" > 

$(document).on("click", "#load", function () {
 /* load all variables */
  
   
   var depid = $(this).data("id");
   
     $.ajax({    //create an ajax request to load_page.php
        type:"POST",  
        url: "menu1.php",    
        dataType: "text",   //expect html to be returned  
        data:{id:depid},               
        success: function(data){                    
         $('#loaddata'+ depid).html(data); 
          

        }

    }); 

  
}); 
</script>
<script type="text/javascript" > 

$(document).on("keyup", "#PartialPayment", function () {
 /* load all variables */
 //alert("goooog")
   
   var totsem = document.getElementById("totsem").value;
   var partial = document.getElementById("PartialPayment").value;
   var bal;

   document.getElementById("partial").value = partial;

   bal = parseFloat(totsem) - parseFloat(partial);

   document.getElementById("Balance").innerHTML = bal.toFixed(2);
   document.getElementById("txtBalance").innerHTML = bal.toFixed(2);
   
}); 
</script>
<script type="text/javascript" > 

$(document).on("click", "#btnpay", function () {
 /* load all variables */
 //alert("goooog")
   
 var partial = document.getElementById("PartialPayment").value;
 
Session.set("PartialPayment", partial);
 
// retreive a session value/object
Session.get("PartialPayment");

// alert(Session.get("PartialPayment"));

 if (partial >= 1600) {
  return true;
 }else{


  alert("invalid payment. Minimum of 1600 pesos in-order to enroll.");
  return false;
 };

 // store a session value/object

 
// clear all session data
// Session.clear();
  
// dump session data
// Session.dump();

   
}); 
</script>
<script>
    // Get references to the radio buttons and input field
    const radioYes = document.getElementById('4psYes');
    const radioNo = document.getElementById('4psNo');
    const beneficiaryIdInput = document.getElementById('beneficiary_id');

    // Add event listeners to the radio buttons
    radioYes.addEventListener('change', function() {
        beneficiaryIdInput.disabled = !this.checked; // Enable/disable based on radio button state
        beneficiaryIdInput.required = this.checked; // Make input required if "Yes" is checked
        if (!this.checked) {
            beneficiaryIdInput.value = ''; // Clear the input if radio button is unchecked
        }
    });

    radioNo.addEventListener('change', function() {
        beneficiaryIdInput.disabled = this.checked; // Enable/disable based on radio button state
        beneficiaryIdInput.required = false; // Remove required attribute if "No" is checked
        if (this.checked) {
            beneficiaryIdInput.value = ''; // Clear the input if radio button is checked
        }
    });
</script>

<script>
    // Get references to the radio buttons and input field
    const disabilityYes = document.getElementById('disabilityYes');
    const disabilityNo = document.getElementById('disabilityNo');
    const disabilityNameInput = document.getElementById('disability_name');

    // Add event listeners to the radio buttons
    disabilityYes.addEventListener('change', function() {
      disabilityNameInput.disabled = !this.checked; // Enable/disable based on radio button state
      disabilityNameInput.required = this.checked; // Make input required if "Yes" is checked
        if (!this.checked) {
          disabilityNameInput.value = ''; // Clear the input if radio button is unchecked
        }
    });

    disabilityNo.addEventListener('change', function() {
      disabilityNameInput.disabled = this.checked; // Enable/disable based on radio button state
      disabilityNameInput.required = false; // Remove required attribute if "No" is checked
        if (this.checked) {
          disabilityNameInput.value = ''; // Clear the input if radio button is checked
        }
    });
</script>

<script>
    // Get references to the radio buttons and input field
    const ipYes = document.getElementById('ipYes');
    const ipNo = document.getElementById('ipNo');
    const ipNameInput = document.getElementById('ip_name');

    // Add event listeners to the radio buttons
    ipYes.addEventListener('change', function() {
      ipNameInput.disabled = !this.checked; // Enable/disable based on radio button state
      ipNameInput.required = this.checked; // Make input required if "Yes" is checked
        if (!this.checked) {
          ipNameInput.value = ''; // Clear the input if radio button is unchecked
        }
    });

    ipNo.addEventListener('change', function() {
      ipNameInput.disabled = this.checked; // Enable/disable based on radio button state
      ipNameInput.required = false; // Remove required attribute if "No" is checked
        if (this.checked) {
          ipNameInput.value = ''; // Clear the input if radio button is checked
        }
    });
</script>


<script>
    // Get references to the radio buttons and input field
    const addressYes = document.getElementById('addressYes');
    const addressNo = document.getElementById('addressNo');
    const PADDRESSInput = document.getElementById('PADDRESS');

    // Add event listeners to the radio buttons
    addressNo.addEventListener('change', function() {
      PADDRESSInput.disabled = !this.checked; // Enable/disable based on radio button state
      PADDRESSInput.required = this.checked; // Make input required if "Yes" is checked
        if (!this.checked) {
          PADDRESSInput.value = ''; // Clear the input if radio button is unchecked
        }
    });

    addressYes.addEventListener('change', function() {
      PADDRESSInput.disabled = this.checked; // Enable/disable based on radio button state
      PADDRESSInput.required = false; // Remove required attribute if "No" is checked
        if (this.checked) {
          PADDRESSInput.value = ''; // Clear the input if radio button is checked
        }
    });
</script>
</body>
</html>