<?php
    if(isset($_POST['submit'])){
        include './pages/conixion.php';
        $userName = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $conPass = $_POST['conPass'];
        $role=$_POST['userRole'];
        if($pass === $conPass){
            var_dump($userName);
            $requete = $con->prepare("INSERT INTO users(username,Email,Password,role)
             VALUES('$userName','$email','$pass','$role')");
            $requete->execute();
            header('location:index.php');
        }
        else{
            header("location:index.php?error=password not found");
        }
    }
?>