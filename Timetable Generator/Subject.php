<!DOCTYPE html>
<html >
<head>
	<title>Add Subject</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<?php
	session_start();
	$servername="localhost";
	$username="root";
	$password="";
    $dbname="Timetable";
	
	$Code=$Name=$Credits=$Class="";
	$CodeErr=$NameErr=$CreditsErr=$ClassErr="";
	$existsErr="";
	$count=0;
	
	$conn=mysqli_connect($servername,$username,$password,$dbname);
	if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SESSION["AdminID"])))
	{
	   if (empty($_POST["scode"])) 
	   {
			$CodeErr = "* Subject code is required";
			$count+=1;
       }
	   else 
	   {
			$Code = test_input($_POST["scode"]);
			if (!preg_match("/^[0-1]{1}[1-9]{1}[0-9]{2}$/",$Code)) 
			{
			$CodeErr = "* Length should be 4. Ex.0701"; 
			$count+=1;
			$Code="";
			}
	   }
	   
	   if (empty($_POST["sname"])) 
	   {
			$NameErr = "* Subject name is required";
			$count+=1;
       }
	   else 
	   {
			$Name = test_input($_POST["sname"]);
			$Name=strtoupper($Name);
			if (!preg_match("/^[a-zA-Z]+$/",$Name)) 
			{
			$NameErr = "* Name should contain only Alphabets. Ex.TAMIL"; 
			$count+=1;
			$Name="";
			}
	   }
	   
	   if (empty($_POST["slectures"])) 
	   {
			$CreditsErr = "* Choose the Number of Lectures";
			$count+=1;
       }
	   else 
	   {
			$Credits= test_input($_POST["slectures"]);
	   }
	   
	   if (empty($_POST["sclass"])) 
	   {
			$ClassErr= "* Choose the Class where only the subject will take";
			$count+=1;
       }
	   else 
	   {
			$Class= test_input($_POST["sclass"]);
	   }
	   
	   if (isset($_POST['submit3']))
	   {
		  if($count==0)
		  {
			if(!$conn)
			{
				die("Connection failed:".mysqli_connect_error());
			}
			$sql="INSERT INTO subject(Code, Name, Credits, ClassNo) VALUES ('".$Code."', '".$Name."', '".$Credits."', '".$Class."')";			
            
			if(mysqli_query($conn,$sql))
			{
				$existsErr="* Subject added successfully";
				$Code=$Name=$Credits=$Class="";
			}
			else
			{
				$existsErr="* Subject already exists";
				//echo "Error:".$sql."<br>".mysqli_error();
			}
	      } 
	   }
	}
	if(!isset($_SESSION["AdminID"]))
	{
		$existsErr="* Unauthorized user. Admin not found";
	}
	
	function test_input($data) 
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>
	<div class="grad"></div>
	<div class="header2">
		<div>Time Table Generator System</div>
	</div>
	<div class="Table" style="height:60%;">
		<ul>
			<li><a href="Teacher.php">Add Teacher</a></li>
			<li style="background-color: #5379fa"><a href="Subject.php">Add Subject</a></li>
			<li><a href="Class.php">Add Class</a></li>
			<li><a href="Classroom.php">Add Classroom</a></li>
			<li><a href="Timetable.php">Time table</a></li>
			<li><a href="Logout.php">Logout</a></li>
        </ul>
		<font style="font-size:20px"><a href="ViewModifySubject.php">View/ Edit/ Remove Subject</a></font>
		<span id="span1"><center><u>Add Subject</u></center></span><br>
		
		<form method="POST">
			<span style="margin-left:37%">Code </span><input type="text" name="scode" value="<?php echo $Code;?>">
				<span style="color:red"> <?php echo $CodeErr;?></span><br><br>
			<span style="margin-left:37%">Name </span><input type="text" name="sname" value="<?php echo $Name;?>">
				<span style="color:red"> <?php echo $NameErr;?></span><br><br>
			<span style="margin-left:30%">Lectures per week </span>
				<select name="slectures" value="<?php echo $Credits;?>">
				<option value="<?php echo $Credits;?>"><?php echo $Credits;?></option>
					   <?php
					       $CreditArr=array("4","5","6","7","8");
							$length = count($CreditArr);
							for ($i = 0; $i < $length; $i++) 
							{
								if($CreditArr[$i]!=$Credits)
								{
									echo '<option value="'.$CreditArr[$i].'">'.$CreditArr[$i].'</option>';
								}			
							}
					   ?>
				</select>
				<span style="color:red"> <?php echo $CreditsErr;?></span><br><br>
				<span style="margin-left:31%">For which class </span>
				<?php
			           $getClasses = "SELECT DISTINCT Class from class";
				       $result = mysqli_query($conn,$getClasses);
				       echo "<select name='sclass'>"; 
				       echo "<option value='$Class'>$Class</option>";
		               while ($row = mysqli_fetch_array($result)) 
						{
							if($row[0]!=$Class)
							{
							echo '<option value="'.$row[0].'">'.$row[0].'</option>';
							}
						}
						echo '</select>';
				?>
				<span style="color:red"> <?php echo $ClassErr;?></span><br><br>
			<input type="submit" value="Add" name="submit3" style="margin-left:45%"><br><br>
			<center style="color:red"><?php echo $existsErr;?></span></center>
		</form>	
	</div>
</body>
</html>
