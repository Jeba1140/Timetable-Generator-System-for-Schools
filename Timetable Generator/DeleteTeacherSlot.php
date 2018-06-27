<!DOCTYPE html>
<html >
<head>
	<title>Delete time slots by teacher</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<div class="grad"></div>
	<div class="header2">
		<div>Time Table Generator System</div>
	</div>
	<div class="Table" style="height:70%;">
		<ul>
			<li><a href="Teacher.php">Add Teacher</a></li>
			<li><a href="Subject.php">Add Subject</a></li>
			<li><a href="Class.php">Add Class</a></li>
			<li><a href="Classroom.php">Add Classroom</a></li>
			<li style="background-color: #5379fa"><a href="Timetable.php">Time table</a></li>
			<li><a href="Logout.php">Logout</a></li>
        </ul>
		<font style="font-size:20px"><a href="GetTeacherID.php">View/ Remove Time Slots By Teacher</a></font><br>
		<span id="span1"><center><u>Choose the time slot</u></center></span><br>
		<?php
			session_start();
		if(isset($_SESSION["AdminID"]))
		{
			$servername="localhost";
			$username="root";
			$password="";
			$dbname="Timetable"; 	
			$error ="";
			$conn=mysqli_connect($servername,$username,$password,$dbname);
			if(!$conn)
			{
				die("Connection failed:".mysqli_connect_error());
			}
			else
			{	
				$getSlots = "SELECT Timeslot from timetable WHERE TeacherID='{$_SESSION['TeacherID2']}' order by Timeslot";
				$result2 = mysqli_query($conn,$getSlots);
				if (!$result2) 
				{
					$error ="No Slots allotted for class<br>";
					echo "MySQL Error: " . mysqli_error($conn);
					exit;
				}
				else
				{
					if ($_SERVER["REQUEST_METHOD"] == "POST") 
					{
						if(isset($_POST['Delete']))
						{
							$slot=$_POST["timeSlot"];
							$deleteTeacherSlot = "DELETE from timetable where Timeslot='$slot' and TeacherID='{$_SESSION['TeacherID2']}'";
							$result = mysqli_query($conn,$deleteTeacherSlot);
							if(!$result)
							{
								$error="* Chosen slot was not allocated. So cannot delete";
							}
							else
							{
								header("location: DeleteTeacherSlot.php"); 
							}
						}
					}
				}	
			}
			mysqli_close($conn);
		}
		if(!isset($_SESSION["AdminID"]))
		{
			$error="* Unauthorized user. Admin not found";
		}
		?>
		<?php
			echo "<form method='POST'>";
			echo "<center><select name='tid' disabled>";
			echo '<option value="'.$_SESSION["TeacherID2"].'">'.$_SESSION["TeacherID2"].'</option>';
			echo '</select></center>';
			echo '<br>';
			echo "<center><select name='timeSlot'>";
			while ($row2 = mysqli_fetch_array($result2)) 
			{
				echo '<option value="'.$row2['Timeslot'].'">'.$row2['Timeslot'].'</option>';
			}
			echo '</select></center>';
			echo '<br>';
			echo "<center><input type='submit' value='Delete' name='Delete' style='margin-left:0%'></center></form>";
			echo "<br><br>";
			echo "<center style='color:red'>";
			echo $error;
			echo "</span></center>";
			echo "</form>";
		?>
	</div>
</body>
</html>
