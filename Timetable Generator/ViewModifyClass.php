<!DOCTYPE html>
<html >
<head>
	<title>View Modify Class</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<div class="grad"></div>
	<div class="header2">
		<div>Time Table Generator System</div>
	</div>
		
	<div class="Table" style="height:55%;">
		<ul>
			<li><a href="Teacher.php">Add Teacher</a></li>
			<li><a href="Subject.php">Add Subject</a></li>
			<li style="background-color: #5379fa"><a href="Class.php">Add Class</a></li>
			<li><a href="Classroom.php">Add Classroom</a></li>
			<li><a href="Timetable.php">Time table</a></li>
			<li><a href="Logout.php">Logout</a></li>
        </ul><br>
		<span id="span1"><center><u>List of Classes</u></center></span><br>
		
		<?php
			session_start();
		if(isset($_SESSION["AdminID"]))
		{
			if(isset($_SESSION["Class"]))
			{
				unset($_SESSION["Class"]);
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
				$getClass = "SELECT * from class";
				$result = mysqli_query($conn,$getClass);
				if (!$result) 
				{
					$error ="No class available<br>";
					echo "MySQL Error: " . mysqli_error($conn);
					exit;
				}
				else
				{
					if ($_SERVER["REQUEST_METHOD"] == "POST") 
					{
						if (isset($_POST['View']))
						{
							$_SESSION["Class"] = $_POST["cid"];
							header("location: ViewClass.php"); 
						}
						else if(isset($_POST['Update']))
						{
							$_SESSION["Class"] = $_POST["cid"];
							header("location: ModifyClass.php"); 
						}
						else if(isset($_POST['Delete']))
						{
							$_SESSION["Class"] = $_POST["cid"];
							$deleteClass = "DELETE from class WHERE ClassName='{$_SESSION['Class']}'";
							$result = mysqli_query($conn,$deleteClass);
							if(!$result)
							{
								echo "<script type='text/javascript'>
								alert('Class already alloted.');  
								</script>";
								header("location: ViewModifyClass.php"); 
							}
							else
							{
								echo "<script type='text/javascript'>
								alert('Deleted successfully.'); 
								</script>";
								header("location: ViewModifyClass.php"); 
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
		   echo "<center><select name='cid'>"; // Open your drop down box 
		   while ($row = mysqli_fetch_array($result)) 
		   {
				echo '<option value="'.$row[2].'">'.$row[2].'</option>';
		   }
			echo '</select></center>';
			echo '<br>';
			echo "<center><input type='submit' value='View' name='View' style='margin-left:0%'></center>";
			echo "<center><input type='submit' value='Update' name='Update' style='margin-left:0%'></center>";
			echo "<center><input type='submit' value='Delete' name='Delete' style='margin-left:0%'></center></form>";
			echo "<br><br>";
			echo "<center style='color:red'>";
			echo $error;
			echo "</span></center>";
		?>
	</div>
</body>
</html>
