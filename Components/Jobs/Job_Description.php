<?php
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/start.php");
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/Header.php");


if (isset($_GET['job_id'])) {
    echo $_GET['job_id'];
} else {
    header("location:/");
}



?>








<main>



</main>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/end.php");
?>