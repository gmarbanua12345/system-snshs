<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>
 <div class="row">
      <div class="col-lg-12">
       	 <div class="col-lg-6">
            <h1 class="page-header">List of Grade Types/Levels  <a href="index.php?view=add" class="btn btn-primary btn-sm ">  <i class="fa fa-plus-circle fw-fa fa-lg"></i> Add New</a>  </h1>
       		</div>
       		<div class="col-lg-6" >
    
</div>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
	 		    <form action="controller.php?action=delete" Method="POST">  
			      <div class="table-responsive">			
				  <table id="dash-table" class="table table-striped table-bordered table-hover" style="font-size:16px" cellspacing="0">

				
				  <thead>
				  	<tr>
				  		<th>#</th>
				  		<th>Secondary Education Types</th>
				  		<th>Grade Levels</th>
				  		<th>Strand</th> 
				  		<th>Description</th>
				  		<th>Department</th>
				  		<th width="10%" >Action</th>
				 
				  	</tr>	
				  </thead>     <!-- `COURSE_NAME`, `COURSE_LEVEL`, ``, `COURSE_DESC`, `DEPT_ID` -->
              
				  <tbody>
				  	<?php 

				  		// $mydb->setQuery("SELECT * 
								// 			FROM  `tblusers` WHERE TYPE != 'Customer'");
				  		$mydb->setQuery("SELECT * 
											FROM  `course` c, `department` d WHERE c.DEPT_ID=d.DEPT_ID");
				  		$cur = $mydb->loadResultList();
	 					$n = 1;
						foreach ($cur as $result) {

							switch ($result->COURSE_LEVEL) {
								case 7:
									# code...
								$Level ='Grade 7';
									break;
								case 8:
									# code...
								$Level ='Grade 8';
									break;
								case 9:
									# code...
								$Level ='Grade 9';
									break;
								case 10:
									# code...
								$Level ='Grade 10';
									break;

								case 11:
									# code...
								$Level ='Grade 11';
									break;
								
								case 12:
									# code...
								$Level ='Grade 12';
									break;
								default:
									# code...
								$Level ='Grade 7';
									break;
							}


				  		echo '<tr>';
				  		echo '<td >' . $n.'</td>';
				  		echo '<td>' . $result->COURSE_NAME.'</a></td>';
				  		echo '<td>'. $Level.'</td>';
				  		echo '<td>'. $result->COURSE_MAJOR.'</td>';
				  		echo '<td>'. $result->COURSE_DESC.'</td>'; 
				  		echo '<td>'. $result->DEPARTMENT_NAME.'</td>';

				  		echo '<td align="center" > <a title="Edit" href="index.php?view=edit&id='.$result->COURSE_ID.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
				  					 <a title="Delete" href="controller.php?action=delete&id='.$result->COURSE_ID.'" class="btn btn-danger btn-xs" ><span class="fa fa-trash-o fw-fa"></span> </a>
				  					 </td>';
				  		echo '</tr>';
						$n++;
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
	

</div> <!---End of container-->