<?php
include "config.php";

$errors = [];
$name = $email = $phone = "" ;

if (isset($_POST['submit'])){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    if($name == ""){
        
        $errors[] = "name filed is required";
    }
    if ($email == ""){
        
        $errors[] = "email filed is required";
    }

    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "invalid email format";
    }


    if($email != ""){

    $stmt = $connection->prepare("SELECT email from students where email = '$email'");
    $stmt->execute();

    if($stmt->fetch()){
        $errors[] = "email aready exist";
    }
    }


    
    
    if($phone != ""){

    $stmt = $connection->prepare("SELECT phone from students where email = '$email'");
    $stmt->execute();

    if($stmt->fetch()){
        $errors[] = "phone aready exist";
    }
    }


    
 //// لما يعدي كل الي فوق
   if (empty($errors)){
    $stmt = $connection->prepare("INSERT INTO students (name, email, phone) VALUES ('$name', '$email','$phone')");
    $stmt->execute();
    header("location: index.php");
    exit;
}

  

}



?>

<form method="post">
    name  <input type="text" name="name" value="<?= $name ?>"> <br>
    email <input type="text" name="email" value="<?= $email ?>"> <br>
    phone <input type="text" name="phone" value="<?= $phone ?>"> <br>

    <button type="submit" name="submit" >add student</button>
</form>