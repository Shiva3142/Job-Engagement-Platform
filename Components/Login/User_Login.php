<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"] . "/Config/DB_connect.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);
    $search_sql = "SELECT * FROM job_seekers WHERE email='$email' AND password='$password';";
    $result = mysqli_query($conn, $search_sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['Id'] = $row['id'];
            $_SESSION['Username'] = explode(" ", $row['name'])[0];
            $_SESSION['isAdmin'] = false;
            header("location:/Components/Home");
        } else {
            $_SESSION['isError'] = true;
            $_SESSION['ErrorMessage'] = "Invalid Credentials";
            $_SESSION['ErrorIsFor'] = "USER|LOGIN";
            header("location:/Components/Login");
        }
    }
} else {
    header("location:/");
}
mysqli_close($conn);
?>