<?php
session_start();
if (isset($_POST['submit'])) {
    include './pages/conixion.php';
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $role=$_POST['userRole'];
    $requete = "SELECT * FROM users WHERE Email = '$email' and Password = '$password'";
    $statment = $con->prepare($requete);
    $statment->execute();
    $result = $statment->fetch();

    if (empty($email) || empty($password)) {
        header("location:index.php?error=please enter your email or password");
    } else if (!$result) {
        header("location:index.php?error=email or password not found");
    } else {
        $_SESSION['name'] = $result['username'];
        $_SESSION['email'] = $result['Email'];
        $_SESSION['password'] = $result['Password'];
        $_SESSION['role'] = $result['role']; // Lấy vai trò của người dùng từ cơ sở dữ liệu

        if (isset($_POST['check'])) {
            setcookie('email', $_SESSION['email'], time() + 3600);
            setcookie('password', $_SESSION['password'], time() + 3600);
        }

        if ($_SESSION['role'] === 'admin') {
            header("location:./pages/dashboard.php"); // Điều hướng đến trang admin
        } else {
            header("location:./pages/dashboard_student.php"); // Điều hướng đến trang người dùng
        }
    }
}
?>
