<?php
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/start.php");

if (isset($_SESSION['Id']) && isset($_SESSION['Username'])) {
} else {
    header("location:/");
}
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/Header.php");

if (isset($_SESSION['Id']) && isset($_SESSION['Username'])) {
    if ($_SESSION['isAdmin']) {
        include($_SERVER["DOCUMENT_ROOT"] . "/Components/Home/Admin_Dashboard.php");
    } else {
        include($_SERVER["DOCUMENT_ROOT"] . "/Components/Home/User_Dashboard.php");
    }
}else{
    header("location:/");
}
?>

<?php
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/end.php");
?>