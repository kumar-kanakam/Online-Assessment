<?php
if(isset($_POST["submit"]))
{
    $name=$_POST["name"];
    $pass=$_POST["password"];
}
  $con = mysqli_connect("localhost", "root","", "log");

    // to ensure that the connection is made
    if (!$con)
    {
        die("Connection failed!" . mysqli_connect_error());
    }
 
   $sql = "SELECT * FROM user";
   
   if($sql){
   $retval = mysqli_query($con, $sql);
   }
   $found=false;
   while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
      if($row['name']==$name){
	  $found=true;
	  $s = "SELECT * FROM user where name='$name'";  
   $re = mysqli_query($con, $s);
   $r=mysqli_fetch_assoc($re);
   if($pass=="{$r['password']}"){
   header("Location:studentdb.php");
   break;
   }
   else{
   //header("Location: index.php");
   echo "<script>alert('invalid password')</script>";
  
  
   break;
   }
	 break; }
	  }
	  if(!$found){
		//header("Location: index.php");
	   echo "<script>alert('incorrect username')</script>";
	   
	  // header("Location: index.php");
   }
   mysqli_close($con);
?>