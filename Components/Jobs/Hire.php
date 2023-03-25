<?php
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/start.php");

if (isset($_SESSION['Id']) && isset($_SESSION['Username'])) {
} else {
    header("location:/");
}
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/Header.php");

if (isset($_SESSION['Id']) && isset($_SESSION['Username'])) {
    if ($_SESSION['isAdmin']) {
        include($_SERVER["DOCUMENT_ROOT"] . "/Config/DB_connect.php");
        $application_id = $_GET['application_id'];
        $sql="UPDATE applications SET status='hired' WHERE application_id=".$application_id;
        $result=mysqli_query($conn, $sql);
        header("location:/Components/Jobs/Application.php?application_id=".$_GET['application_id']);
    } else {
        header("location:/");
    }
}
?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/end.php");
?>