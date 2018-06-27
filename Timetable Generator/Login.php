<!DOCTYPE html>
<html >
<head>
	<title>Time table generator</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<?php
     session_start();
	 if(isset($_SESSION["AdminID"]))
     {
	   unset($_SESSION["AdminID"]);
     }
     $servername="localhost";
	 $username="root";
     $password="";
     $dbname="Timetable";
	 $conn=mysqli_connect($servername,$username,$password,$dbname);
	 $error="";
	 $Errcount=0;
	 
	 if ($_SERVER["REQUEST_METHOD"] == "POST") 
	 {
		$id=$_POST["AdminID"];
		$password=$_POST["AdminPassword"];
		
		if (empty($id)) 
	    {
			$error = " * Enter your ID";
			$Errcount+=1;
        }
		
		if (empty($password))
		{
		   $error=" * Password field should not be empty";	
		   $Errcount+=1;
		}
		
		if(empty($id) && empty($password))
		{
		    $error=" * Enter Id and Password";	
		    $Errcount+=1;
		}
 
		if (isset($_POST['submit1']))
		{
		  if($Errcount==0)
		  {
			$sql="SELECT * FROM admin WHERE admin_id='$id' and admin_pass='$password'";
			$result=mysqli_query($conn,$sql);
			$count = mysqli_num_rows($result);
		
			if($count == 1) 
			{
				$_SESSION["AdminID"] = $id;
				header("location: Teacher.php");
			}
			else 
			{
				$error = " * Invalid credentials. You are not an admin";
			}
		  }
		}
	 }
  ?>
	<div class="grad"></div>
	<div class="header">
		<div>Time Table Generator System</div>
	</div><br>
	<div class="login">
		<form method="POST">
			<input type="text" placeholder="Admin ID" name="AdminID"><br>
			<input type="password" placeholder="Password" name="AdminPassword"><br>
			<input type="submit" value="Login" id="Loginbutton" name="submit1" style="width: 260px;height: 35px; background: #fff; border: 1px solid #fff; cursor: pointer; border-radius: 2px; color: #a18d6c;	font-family: 'Exo', sans-serif; font-size: 16px; font-weight: 400;padding: 6px; margin-top: 10px;">
			<!-- style="width: 260px;height: 35px; background: #fff; border: 1px solid #fff; cursor: pointer; border-radius: 2px; color: #a18d6c;	font-family: 'Exo', sans-serif; font-size: 16px; font-weight: 400;padding: 6px; margin-top: 10px;"-->
		</form><br>
		<span style="color:white"><?php echo "$error";?></span>
	</div>
</body>

</html>
