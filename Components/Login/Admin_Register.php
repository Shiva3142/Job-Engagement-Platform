<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"] . "/Config/DB_connect.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $company = $_POST['company'];
    $phone = substr($phone, strlen($phone) - 10, 10);
    $search_sql = "SELECT * FROM hiring_admins WHERE email='$email' OR number='$phone';";
    $result = mysqli_query($conn, $search_sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['isError'] = true;
            $_SESSION['ErrorMessage'] = "Admin Account already exists";
            $_SESSION['ErrorIsFor'] = "ADMIN|REGISTER";
            header("location:/Components/Login");
        } else {
            $id = md5($email);
            $password = md5($password);
            $insert_sql = "INSERT INTO hiring_admins(id,email,name,number,password,company_name) VALUES('$id','$email','$name',$phone,'$password','$company');";
            $result = mysqli_query($conn, $insert_sql);
            if ($result) {
                $_SESSION['Username'] = explode(" ", $name)[0];
                $_SESSION['Id'] = $id;
                $_SESSION['isAdmin'] = true;
                header("location:/Components/Home");
            } else {
                $_SESSION['isError'] = true;
                $_SESSION['ErrorMessage'] = "Some Problem ocurred in registering";
                $_SESSION['ErrorIsFor'] = "ADMIN|REGISTER";
                header("location:/Components/Login");
            }
        }
    }
} else {
    header("location:/");
}
mysqli_close($conn);
?>