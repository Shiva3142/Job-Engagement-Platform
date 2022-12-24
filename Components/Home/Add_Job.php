<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"] . "/Config/DB_connect.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $position = $_POST['position'];
    $location = $_POST['location'];
    $type = $_POST['type'];
    $level = $_POST['level'];
    $last_date = $_POST['date'];
    $number_of_positions = $_POST['number'];
    $skills = $_POST['skills'];
    $responsibilities = $_POST['responsibilities'];
    $eligibilities = $_POST['eligibilities'];
    $benefits = $_POST['benefits'];
    $admin_id = $_SESSION['Id'];
    $company = $_SESSION['Company'];
    $job_id = md5($admin_id . date("Y-m-d h:i:sa"));
    // $insert_sql = "INSERT INTO jobs(job_id,position_name,company_name,place,number_of_positions,job_level,skills_required,responsibilities,eligibilities,benefits,package,monthly_pay,admin_id,time_range,last_date_to_apply,type) VALUES('$job_id','$position','$company','$location',$number_of_positions,'$level','$skills','$responsibilities','$eligibilities','$benefits','$package','$salary','$admin_id','$month','$last_date');";
    $insert_sql = "";
    if ($type == 'internship') {
        $month = $_POST['month'];
        $salary = $_POST['salary'];
        $insert_sql = "INSERT INTO jobs(job_id,position_name,company_name,place,number_of_positions,job_level,skills_required,responsibilities,eligibilities,benefits,monthly_pay,admin_id,time_range,last_date_to_apply,type) VALUES('$job_id','$position','$company','$location',$number_of_positions,'$level','$skills','$responsibilities','$eligibilities','$benefits',$salary,'$admin_id','$month','$last_date','$type');";
    } else {
        $package = $_POST['package'];
        $insert_sql = "INSERT INTO jobs(job_id,position_name,company_name,place,number_of_positions,job_level,skills_required,responsibilities,eligibilities,benefits,package,admin_id,last_date_to_apply,type) VALUES('$job_id','$position','$company','$location',$number_of_positions,'$level','$skills','$responsibilities','$eligibilities','$benefits',$package,'$admin_id','$last_date','$type');";
    }
    $result = mysqli_query($conn, $insert_sql);
    if ($result) {
        $_SESSION['isSuccess'] = true;
        $_SESSION['SuccessMessage'] = "Job Posted Successfully";
        $_SESSION['SuccessIsFor'] = "ADMIN|JOB_POSTING";
        header("location:/Components/Home");
    }
} else {
    header("location:/");
}
mysqli_close($conn);
?>