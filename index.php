<?php
   include("db.php");
   include("header.php");
      $flag=0;
      $update=0;
      if(isset($_POST['Update'])){
   	
   		 foreach($_POST['attendance_status'] as $id=>$attendance_status)
   		   {
   			$date=$_POST['date'][$id];
      
   			$student_name=$_POST['student_name'][$id];
   			$roll_number=$_POST['roll_number'][$id];
   			
   			$result=mysqli_query($con,"update attendance_records set student_name='$student_name',roll_number='$roll_number',attendance_status='$attendance_status',date='$date'
   			where date='$date' and  roll_number='$roll_number';
   			
   			");
   			if($result)
   			{
   			$update=1;	
   			}	
   					
   			   
   		   }   
   	   
   	   
      }
      if(isset($_POST['submit']))
      {
   	   $date=date("Y-m-d");
   	   
   
   	   $records=mysqli_query($con,"select * from attendance_records where date='$date'");;
   	   $num=mysqli_num_rows($records);
   	   
   	   if($num)
   	   {
   		 
           		 
   	   }
   	   else
   	   {	   
   		   foreach($_POST['attendance_status'] as $id=>$attendance_status)
   		   {
   			$student_name=$_POST['student_name'][$id];
   			$roll_number=$_POST['roll_number'][$id];
   			
   			
   			$result=mysqli_query($con,"insert into attendance_records(student_name,roll_number,attendance_status,date)values('$student_name','$roll_number','$attendance_status','$date')");
   			if($result)
   			{
   			$flag=1;	
   			}	
   					
   			   
   		   }
   	   }
      }	   
   
   ?>
<div class="panel panel-default">
   <div class="panel panel-heading">
      <h2>
         <a class="btn btn-success" href="add.php">Add Student </a>
         <a class="btn btn-info pull-right" href="view_all.php"> View All </a>
      </h2>
      <?php if($flag){ ?>
      <div class="alert alert-success">
         Attendance Data Inserted Successfully
      </div>
      <?php } ?>
      <?php if($update){ ?>
      <div class="alert alert-success">
         Student Attandance updated successfully.
      </div>
      <?php } ?>
      <H3>
         <div class="well text-center">Date:<?php echo date("Y-m-d"); ?>  </div>
      </H3>
      <div class="panel panel-body">
         <form action="index.php" method="Post">
            <table class="table table-striped">
               <tr>
                  <th>#serial Number</th>
                  <th>Student Name</th>
                  <th>Roll Number</th>
                  <th> Attendance Status </th>
               </tr>
               <?php 
                  $date=date("Y-m-d");
                  $result=mysqli_query($con,"SELECT attendance.student_name,attendance.roll_number,attendance_records.attendance_status FROM attendance LEFT JOIN attendance_records ON attendance.roll_number = attendance_records.roll_number and date='$date'");
                  $serialnumber=0;
                  $counter=0;
                  while($row=mysqli_fetch_array($result))
                  {
                  $serialnumber++;
                  
                  
                  ?>
               <tr>
                  <td> <?php echo $serialnumber; ?>  </td>
                  <td> <?php echo $row['student_name']; ?>  
                     <input type="hidden" value="<?php echo $row['student_name']; ?>" name="student_name[]">
                  </td>
                  <td> <?php echo $row['roll_number']; ?>  
                     <input type="hidden" value="<?php echo $row['roll_number']; ?>" name="roll_number[]">
                  </td>
                  <td>
                     <input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Present"
                        <?php if($row['attendance_status']=="Present"){ 	
                           echo "checked=checked";
                           }
                           ?>
                        required >Present
                     <input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Absent" 
                        <?php if($row['attendance_status']=="Absent"){ 	
                           echo "checked=checked";
                           }
                           ?>
                        required>Absent
                  </td>
               </tr>
               <?php 
                  $counter++;
                  }
                  ?>
            </table>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">	

         </form>
      </div>
   </div>
</div>