<!DOCTYPE html>
<html lang="en">
<head>
    <style>
       body {
    font-family: Arial, sans-serif;
    background-image: url('regimg6.jpeg')    ;
    background-size: 100%; 
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

form {
    display: flex;
    flex-direction: column;
    border: 2px solid black;
    border-radius: 10px;
    width: 300px;
    padding: 30px;
    font-size: 16px;
    background-color: transparent;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

input[type="text"],
input[type="password"] {
    padding: 10px;
    background-color: transparent;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="submit"] {
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
    transform: translateY(-5px);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
}

.error {
    color: red;
    font-size: 14px;
    margin-top: 5px;
}



    </style>
    <script>
        function validateForm() {
            var gmail = document.getElementById("gmail").value;
            var mobile = document.getElementById("mobileno").value;

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var mobileRegex = /^\d{10}$/;

            if (document.myform.name.value == "") {
                alert("Enter name");
				document.myform.name.focus();
                return false;
            } 
			if (document.myform.rollno.value.length == "") {
                alert("Enter rollno");
				document.myform.rollno.focus();
                return false;
            }
			if (document.myform.password.value.length <= 6) {
                alert("Password should contain atleast 6 characters");
				document.myform.password.focus();
                return false;
            }
			if (document.myform.password.value!== document.myform.retype.value) 
			{
                alert("Password and Retype Password do not match");
				document.myform.retype.focus();
                return false;
            }
			if (!emailRegex.test(gmail)) {
                alert("Invalid email address.");
				document.myform.gmail.focus();
                return false;
            }
			if (!mobileRegex.test(mobile)) {
                alert("Invalid mobile number. Please enter a 10-digit number without spaces or special characters.");
				document.myform.mobileno.focus();
                return false;
            }
                return true;
            }
        
        function next(event,index)
        {
            if(event.key==="Enter"){
                event.preventDefault();
                document.querySelector(`[id="${index}"]`).focus();
            }
        }
    </script>
</head>
<body>
    <form name="myform" method="post" action="action.php" onsubmit="return validateForm()">
        Full Name: <input type="text" name="name" id="name" onkeydown="next(event,'rollno')">
        Roll No: <input type="text" name="rollno" id="rollno" onkeydown="next(event,'password')">
        Password: <input type="password" name="password" id="password" onkeydown="next(event,'retype')">
        Re-Type password: <input type="password" name="retype" id="retype" onkeydown="next(event,'gmail')">
        G-Mail: <input type="text" name="gmail" id="gmail" onkeydown="next(event,'branch')">
        Branch: <input type="text" name="branch" id="branch" onkeydown="next(event,'mobileno')">
        MobileNo: <input type="text" name="mobileno" id="mobileno"><br>
        <input type="submit" name="submit" id="submit" value="Submit">
    </form>
</body>
</html>
