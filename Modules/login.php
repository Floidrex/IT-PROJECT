<?php
include "config.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $conn->real_escape_string($_POST["password"]);
    $hash_pass = md5($password);
    
    if(!empty($username) && !empty($password)){
        echo "please log in";
    }else{
        $stmt = "SELECT * FROM accounts WHERE Name = $username AND password = $hash_pass ";
        $result = $conn->query($stmt);

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            if($row["position"] = "waitStaff"){
                $_SESSION['username']= $username; 
                header("location: waitStaff.php");
            }else if($row["position"] = "cashier"){
                $_SESSION['username']= $username; 
                header("location: cashier.php");
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <form action="login.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password"  placeholder="Password">
        <input type="submit" value="Login"> 
    </form>
    </div>
</body>
</html>
