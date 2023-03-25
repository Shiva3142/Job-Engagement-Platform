<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"] . "/Config/DB_connect.php");

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['Id']) && isset($_SESSION['Username']) && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == false) {
    $files = $_FILES['file'];
    $job_id=$_POST['job_id'];
    echo $job_id;

    echo var_dump($_FILES['file']);
    foreach ($files as $file) {
        echo var_dump($file);
        echo "<br/>";
    }
    echo var_dump($_FILES['file']['tmp_name']);
    $file_name = $_FILES['file']['name'];
    $resume_location="/Files/Resumes/".$_SESSION['Id']."_". $file_name;
    $location = $_SERVER["DOCUMENT_ROOT"] . $resume_location;
    move_uploaded_file($_FILES['file']['tmp_name'], $location);
    $sql="INSERT INTO applications (applicant_id,job_id,resume_file_location) VALUES ('".$_SESSION['Id']."','$job_id','$resume_location')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("location:/Components/Home");
    } else {
        header("location:/Components/Home");
    }
}


?>