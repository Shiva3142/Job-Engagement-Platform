<?php
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/start.php");

if (isset($_SESSION['Id']) && isset($_SESSION['Username']) && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
} else {
    header("location:/");
}
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/Header.php");
?>

<main>





</main>

<?php
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/end.php");
?>