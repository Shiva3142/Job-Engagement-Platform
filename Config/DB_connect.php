<?php
    $myfile = fopen($_SERVER["DOCUMENT_ROOT"] . "/Config/config.env", "r") or die("Unable to open file!");
    $data=fread($myfile,filesize($_SERVER["DOCUMENT_ROOT"] . "/Config/config.env"));
    $data=explode(" ",$data);
    fclose($myfile);
    $server=$data[0];
    $username=$data[1];
    $password=$data[2];
    $port=$data[3];
    $database=$data[4];
    $conn=mysqli_connect($server,$username,$password,$database,$port);
    if(!$conn)
    {
        echo "error".mysqli_connect_error($conn);
    }else{
    }
?>