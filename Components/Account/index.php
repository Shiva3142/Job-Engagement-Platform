<?php
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/start.php");

if (isset($_SESSION['Id']) && isset($_SESSION['Username'])) {
} else {
    header("location:/");
}
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/Header.php");

if (isset($_SESSION['Id']) && isset($_SESSION['Username'])) {
    if ($_SESSION['isAdmin']) {
        include($_SERVER["DOCUMENT_ROOT"] . "/Components/Account/Recruiters_Account.php");
    } else {
        include($_SERVER["DOCUMENT_ROOT"] . "/Components/Account/User_Account.php");
    }
}
?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/end.php");
?>