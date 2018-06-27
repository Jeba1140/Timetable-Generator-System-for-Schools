<!DOCTYPE html>
<html >
<head>
	<title>Create timetable</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<?php
	$servername="localhost";
	$username="root";
	$password="";
    $dbname="Timetable";
	
	$TeacherID=$Code=$Class=$Section=$RoomNo=$Timeslot="";
	$TeacherIDErr=$CodeErr=$ClassErr=$SectionErr=$RoomNoErr=$TimeslotErr="";
	$existsErr="";
	$count=0;
	
	$conn=mysqli_connect($servername,$username,$password,$dbname);
	if(!$conn)
	{
		die("Connection failed:".mysqli_connect_error());
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
	   if (empty($_POST["tid"])) 
	   {
			$TeacherIDErr= "* Techer ID is required";
			$count+=1;
       }
	   else 
	   {
			$TeacherID = test_input($_POST["tid"]);
	   }
	   
	   if (empty($_POST["scode"])) 
	   {
			$CodeErr = "* Subject code is required";
			$count+=1;
       }
	   else 
	   {
			$Code = test_input($_POST["scode"]);
			$sql="SELECT Subject FROM teacher where ID='$TeacherID'";	
			$sql2="SELECT Name FROM subject where Code='$Code'";
			$result=mysqli_query($conn,$sql);
			$result2=mysqli_query($conn,$sql2);
			$row=mysqli_fetch_array($result);
			$row2=mysqli_fetch_array($result2);
			if($row['Subject']!=$row2['Name'])
			{
				$CodeErr ="* Chosen teacher will not take this subject.";
				$count+=1;
				$Code="";
			}
	   }
	   
	   if (empty($_POST["class"])) 
	   {
			$ClassErr = "* Choose class";
			$count+=1;
       }
	   else 
	   {
			$Class = test_input($_POST["class"]);
			$sql="SELECT ClassNo FROM subject where Code='$Code'";	
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($result);
			$ClassNo=$row['ClassNo'];
			$cnt4 = mysqli_num_rows($result);
			if($cnt4>0)
			{
				if($Class!=$ClassNo)
				{
					$ClassErr="* The subject can only taken by class $ClassNo";
					$count+=1;
					$Class="";	
				}
			}
			
	   }
	   
	   if (empty($_POST["section"])) 
	   {
			$SectionErr = "* Choose section";
			$count+=1;
       }
	   else 
	   {
			$Section = test_input($_POST["section"]);
			$sql="SELECT * FROM class where Class='$Class'";	
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($result);
			$cnt = mysqli_num_rows($result);
			
			if($Section=='A')
			{
				$Value=1;
			}
			else if($Section=='B')
			{
				$Value=2;
			}
			else if($Section=='C')
			{
				$Value=3;
			}
			else if($Section=='D')
			{
				$Value=4;
			}
			else
			{
				$Value=5;
			}
			
			if($cnt != 1) 
			{
				$SectionErr = " * Class does not exists";
				$count+=1;
				$Section ="";
			}
			else
			{
				$Sec=$row["NoOfSections"];
				if($Value>$Sec)
				{
					$SectionErr = " * Section does not exists in $Class th class";
					$count+=1;
				    $Section ="";
				}
				else
				{
					$sql3="SELECT TeacherID FROM timetable where SubjectCode='$Code' and Class='$Class' and Section='$Section'";
					$result3=mysqli_query($conn,$sql3);
					$row3=mysqli_fetch_array($result3);
					$teacherPre=$row3['TeacherID'];
					$cnt3 = mysqli_num_rows($result3);
					if($cnt3>0)
					{
						if($TeacherID!=$teacherPre)
						{
						   $TeacherIDErr="* Another teacher($teacherPre) already take the subject chosen for $Class$Section";
						   $count+=1;
						   $Section ="";	
						}
					}
				}
			}
	   }
	   
	   if (empty($_POST["classroom"])) 
	   {
			$RoomNoErr = "* Enter classroom";
			$count+=1;
       }
	   else 
	   {
			$RoomNo = test_input($_POST["classroom"]);
			$sql="SELECT RoomNo FROM timetable where  Class='$Class' and Section='$Section'";
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($result);
			$RoomNumber=$row['RoomNo'];
			$cnt4 = mysqli_num_rows($result);
			if($cnt4>0)
			{
				if($RoomNo!=$RoomNumber)
				{
					$RoomNoErr ="* For Class $Class$Section, room number $RoomNumber was alloted already";
					$count+=1;
					$RoomNo="";
				}
			}
	   }
	   
	   if (empty($_POST["timeslot"])) 
	   {
			$TimeslotErr = "* Enter timeslot";
			$count+=1;
       }
	   else 
	   {
			$Timeslot = test_input($_POST["timeslot"]);
			if (!preg_match("/^[A-T]{1}[1-2]{1}$/",$Timeslot)) 
			{
			$TimeslotErr = "* Timeslot should be between A1-T1 or A2-T2"; 
			$count+=1;
			$Timeslot="";
			}
			else
			{
				$sql="SELECT * FROM timetable where TeacherID='$TeacherID' and Timeslot='$Timeslot'";	
				$result=mysqli_query($conn,$sql);
				$row=mysqli_fetch_array($result);
				$cnt = mysqli_num_rows($result);
				if($cnt>0)
				{
					$TimeslotErr="* Timeslot already allocated. Choose another slot";
					$count+=1;
			        $Timeslot="";
				}
				else
				{
					$sql2="SELECT * FROM timetable where RoomNo='$RoomNo' and Timeslot='$Timeslot'";	
					$result2=mysqli_query($conn,$sql2);
					$row2=mysqli_fetch_array($result2);
					$cnt2 = mysqli_num_rows($result2);
					if($cnt2>0)
					{
					$RoomNoErr="* Selected room is not free on the selected timeslot";
					$count+=1;
					$RoomNo="";
					}
					else
					{
						$sql3="SELECT * FROM timetable where Class='$Class' and Section='$Section' and Timeslot='$Timeslot'";
						$result3=mysqli_query($conn,$sql3);
						$row3=mysqli_fetch_array($result3);
						$cnt3 = mysqli_num_rows($result3);
						if($cnt3>0)
						{
						$TimeslotErr="* $Class $Section have another class on this timeslot";
						$count+=1;
						$Timeslot="";
						}
					}
				}

			}
	   }
	   
	   if (isset($_POST['submit6']))
	   {
		  if($count==0)
		  {
			if(!$conn)
			{
				die("Connection failed:".mysqli_connect_error());
			}
			$sql="INSERT INTO timetable(TeacherID, SubjectCode, Class, Section, RoomNo, Timeslot) VALUES ('".$TeacherID."', '".$Code."', '".$Class."', '".$Section."', '".$RoomNo."', '".$Timeslot."')";			
                                                       
			if(mysqli_query($conn,$sql))
			{
				$existsErr="* Time Slot allotted successfully";
				
				$TeacherID=$Code=$Class=$Section=$RoomNo=$Timeslot="";
			}
			else
			{
				$existsErr="* Timeslot already exists for teacher";
				//echo "Error:".$sql."<br>".mysqli_error();
			}
			
	      } 
	   }
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
	<div class="Table" style="height:70%;">
		<ul>
			<li><a href="Teacher.php">Add Teacher</a></li>
			<li><a href="Subject.php">Add Subject</a></li>
			<li><a href="Class.php">Add Class</a></li>
			<li><a href="Classroom.php">Add Classroom</a></li>
			<li style="background-color: #5379fa"><a href="Timetable.php">Time table</a></li>
			<li><a href="Logout.php">Logout</a></li>
        </ul><br>
		<span id="span1"><center><u>Create Timetable</u></center></span><br>
		
		<form method="POST">
			<span style="margin-left:33%">Teacher ID </span>
			<?php
			   $getTeachers = "SELECT * from teacher";
				$result = mysqli_query($conn,$getTeachers);
				echo "<select name='tid'>";
				echo "<option value='$TeacherID'>$TeacherID</option>";
		        while ($row = mysqli_fetch_array($result)) 
				{
					if($row[0]!=$TeacherID)
					{
					echo '<option value="'.$row[0].'">'.$row[0].' - '.$row[1].'</option>';
					}
				}
			   echo '</select>';
			?>
			<span style="color:red"> <?php echo $TeacherIDErr;?></span><br><br>
			<span style="margin-left:32%">Subject Code </span>
			<?php
			   $getSubjects = "SELECT * from subject";
				$result = mysqli_query($conn,$getSubjects);
				echo "<select name='scode'>"; 
				echo "<option value='$Code'>$Code</option>";
		        while ($row = mysqli_fetch_array($result)) 
				{
					if($row[0]!=$Code)
					{
					echo '<option value="'.$row[0].'">'.$row[0].' - '.$row[1].'</option>';
					}
				}
			   echo '</select>';
			?>
				<span style="color:red"> <?php echo $CodeErr;?></span><br><br>
			<span style="margin-left:36%">Class </span>
			<?php
			   $getClass = "SELECT * from class";
				$result = mysqli_query($conn,$getClass);
				echo "<select name='class'>"; 
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
			<span style="margin-left:35%">Section </span>
				<select name="section">  
				<option value="<?php echo $Section;?>"><?php echo $Section;?></option>
				<?php
					$SectionsArr=array("A","B","C","D","E");
					$length = count($SectionsArr);
					for ($i = 0; $i < $length; $i++) 
					{
						if($SectionsArr[$i]!=$Section)
						{
							echo '<option value="'.$SectionsArr[$i].'">'.$SectionsArr[$i].'</option>';
						}			
					}
				?>
				</select>
				<span style="color:red"> <?php echo $SectionErr;?></span><br><br>
			<span style="margin-left:33%">Classroom </span>
			<?php
			   $getClassroom = "SELECT * from classroom";
				$result = mysqli_query($conn,$getClassroom);
				echo "<select name='classroom'>"; 
				echo "<option value='$RoomNo'>$RoomNo</option>";
		        while ($row = mysqli_fetch_array($result)) 
				{
					if($row[0]!=$RoomNo)
					{
					echo '<option value="'.$row[0].'">'.$row[0].'</option>';
					}
				}
			   echo '</select>';
			?>
				<span style="color:red"> <?php echo $RoomNoErr;?></span><br><br>
			<span style="margin-left:34%">Timeslot </span><input type="text" name="timeslot" value="<?php echo $Timeslot;?>">
				<span style="color:red"> <?php echo $TimeslotErr;?></span><br><br>
			<input type="submit" value="Create" style="margin-left:44%" name="submit6"><br><br>
			<center style="color:red"><?php echo $existsErr;?></span></center>
		</form>	
	</div>
</body>
</html>
