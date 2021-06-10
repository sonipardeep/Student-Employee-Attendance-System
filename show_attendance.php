<?php
   include("db.php");
   include("header.php");
?>
<div class="panel panel-default">
   <div class="panel panel-heading">
      <h2>
         <a class="btn btn-success" href="add.php">Add Student </a>
         <a class="btn btn-info pull-right" href="index.php"> Back </a>
      </h2>
      <div class="panel panel-body">
         <form action="index.php" method="Post">
            <table class="table table-striped">
               <tr>
                  <th>#Serial Number</th>
                  <th>Student Name</th>
                  <th>Roll Number</th>
                  <th>Attendance Status </th>
               </tr>
               <?php 
                  $result=mysqli_query($con,"select * from attendance_records where date='$_POST[date]'");
                     $serialnumber=0;
                  $counter=0;
                  while($row=mysqli_fetch_array($result))
                  {
                  $serialnumber++;
                  ?>
               <tr>
                  <td> <?php echo $serialnumber; ?>  </td>
                  <td> <?php echo $row['student_name']; ?>  	<input type="hidden" value="<?php echo $row['student_name']; ?>" name="student_name[]">
                  </td>
                  <td> <?php echo $row['roll_number']; ?> 
                     <input type="hidden" value="<?php echo $row['roll_number']; ?>" name="roll_number[]">
                     <input type="hidden" value="<?php echo $row['date']; ?>" name="date[]">
                  </td>
                  <td> 
                     <input type="radio" name="attendance_status[<?php echo $counter; ?>]" 
                        <?php if($row['attendance_status']=="Present")
                           echo "checked=checked";
                           ?>
                        value="Present" >Present
                     <input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Absent"
                        <?php if($row['attendance_status']=="Absent")
                           echo "checked=checked";
                           ?>
                        >Absent
                  </td>
               </tr>
               <?php 
                  $counter++;
                  }
                  ?>
            </table>
            <input type="submit" name="Update" value="Update" class="btn btn-primary">	
         </form>
      </div>
   </div>
</div>