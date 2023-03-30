<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"] . "/Config/DB_connect.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = strtolower($_POST['email']);
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $phone = substr($phone, strlen($phone) - 10, 10);
    $search_sql = "SELECT * FROM job_seekers WHERE email='$email' OR number='$phone';";
    $result = mysqli_query($conn, $search_sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['isError'] = true;
            $_SESSION['ErrorMessage'] = "user already exists";
            $_SESSION['ErrorIsFor'] = "USER|REGISTER";
            header("location:/Components/Login");
        } else {
            $id = md5($email);
            $password = md5($password);
            $insert_sql = "INSERT INTO job_seekers(id,email,name,number,password) VALUES('$id','$email','$name',$phone,'$password');";
            $result = mysqli_query($conn, $insert_sql);
            if ($result) {
                $_SESSION['Username'] = explode(" ", $name)[0];
                $_SESSION['Id'] = $id;
                $_SESSION['isAdmin'] = false;
                header("location:/Components/Home");
            } else {
                $_SESSION['isError'] = true;
                $_SESSION['ErrorMessage'] = "Some Problem ocurred in registering";
                $_SESSION['ErrorIsFor'] = "USER|REGISTER";
                header("location:/Components/Login");
            }
        }
    }
} else {
    header("location:/");
}
mysqli_close($conn);
?>