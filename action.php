<?php
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $rollno = $_POST["rollno"];
    $password =$_POST["password"];
    $gmail = $_POST["gmail"];
    $branch = $_POST["branch"];
    $mobileno = $_POST["mobileno"];
}

$con = mysqli_connect("localhost", "root", "", "log");

if (!$con) {
    echo "not connected ";
}

$sr = "INSERT INTO user(name, rollno, password, gmail, branch, mobileno) VALUES('$name', '$rollno', '$password','$gmail','$branch','$mobileno')";
$rs = mysqli_query($con, $sr);
$st = "INSERT INTO result(rollno,test2,test3,test4,test5,test1) VALUES('$rollno','null','null','null','null','null')";
$rt = mysqli_query($con, $st);
if ($rs && $st) {
    header("Location: index.php");
} else {
    echo "Error in insertion: " . mysqli_error($con);
}

mysqli_close($con);
?>
