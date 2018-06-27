<!DOCTYPE html>
<html >
<head>
	<title>Timetable</title>
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
        </ul><br>
		<span id="span1"><center><u>Choose the Class</u></center></span><br>
		<?php
			session_start();
		if(isset($_SESSION["AdminID"]))
		{
			if(isset($_SESSION["ClassNameTT"]))
			{
				unset($_SESSION["ClassNameTT"]);
			}	
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
				$getClassName = "SELECT distinct ClassName from timetable";
				$getSlots = "SELECT distinct Timeslot from timetable";
				$result = mysqli_query($conn,$getClassName);
				$result2 = mysqli_query($conn,$getSlots);
				if (!$result) 
				{
					$error ="No Class available<br>";
					echo "MySQL Error: " . mysqli_error($conn);
					exit;
				}
				else
				{
					if ($_SERVER["REQUEST_METHOD"] == "POST") 
					{
						if (isset($_POST['View']))
						{
							$_SESSION["ClassNameTT"] = $_POST["className"];
							header("location: ViewTTBC.php"); 
						}
						else if(isset($_POST['Delete']))
						{
							$_SESSION["ClassNameTT"] = $_POST["className"];
							header("location: DeleteClassSlot.php");
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
		   echo "<center><select name='className'>"; // Open your drop down box 
		   while ($row = mysqli_fetch_array($result)) 
		   {
				echo '<option value="'.$row['ClassName'].'">'.$row['ClassName'].'</option>';
		   }
			echo '</select></center>';
			echo '<br>';
			
			echo "<center><input type='submit' value='View' name='View' style='margin-left:0%'></center>";
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
