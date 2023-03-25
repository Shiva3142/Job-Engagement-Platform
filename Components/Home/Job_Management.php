<?php
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/start.php");

if (isset($_SESSION['Id']) && isset($_SESSION['Username']) && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
} else {
    header("location:/");
}
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/Header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/Config/DB_connect.php");

?>

<main>
    <div class="adminDashboard">
        <h1 class="centered-main-heading">Edit Your Opportunity</h1>
        <section class="jobFormContainer" id="jobFormContainer" style="display:flex;">
            <?php
            $sql = "SELECT * FROM jobs WHERE job_id='$_GET[job_id]' AND admin_id='$_SESSION[Id]'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    echo '
        <form action="Update_job.php" method="post">
<input type="text" name="job_id" id="job_id" value="' . $_GET['job_id'] . '" style="display:none">
        <h4>Enter Position Name</h4>
        <input required type="text" value="' . $row['position_name'] . '" name="position" id="position"
            placeholder="Enter Position Name">
        <h4>Enter Location of Job</h4>
        <input required type="text" name="location" value="' . $row['place'] . '" id="location"
            placeholder="Enter Location of Job">
        <h4>Select Type of Job</h4>
        <div>
            <input required type="radio" name="type" id="type1" onclick="toggleBetweenJobAndInternshipInputs(1)"
                value="job">
            <label for="type1">Job</label>
            <input required type="radio" name="type" id="type2" onclick="toggleBetweenJobAndInternshipInputs(2)"
                value="internship">
            <label for="type2">Internship</label>
        </div>
        <h4>Select Level of Job</h4>
        <div>
            <input required type="radio" name="level" id="level1" value="Fresher" checked>
            <label for="level1">Fresher</label>
            <input required type="radio" name="level" id="level2" value="Intermediate">
            <label for="level2">Intermediate</label>
            <input required type="radio" name="level" id="level3" value="Advanced">
            <label for="level3">Advanced</label>
        </div>
        <h4>Enter Last Date of Application</h4>
        <input required type="date" name="date" id="date" value="' . $row['last_date_to_apply'] . '" placeholder="Enter Last Date of Application">
        <h4>Enter Number Positions</h4>
        <input required type="number" name="number" value="' . $row['number_of_positions'] . '" id="number" placeholder="Enter Number Positions">
        <h4 class="month">Enter Number of Months</h4>
        <input type="text" name="month" class="month" value="' . $row['time_range'] . '" placeholder="Enter Number of Months">
        <h4 class="package">Enter salary Per Annum(in LPA)</h4>
        <input type="text" name="package" class="package" value="' . $row['package'] . '" placeholder="Enter salary Per Annum">
        <h4 class="salary">Enter Salary Per Month</h4>
        <input type="text" name="salary" class="salary" value="' . $row['monthly_pay'] . '" placeholder="Enter Salary Per Month">
        <h4>Enter Required Skills</h4>
        <textarea required name="skills" id="skills"
            placeholder="Enter Job Skills With Separated by Comma">' . $row['skills_required'] . '</textarea>
        <h4>Enter Job Responsibilities</h4>
        <textarea required name="responsibilities" id="responsibilities"
            placeholder="Enter Job Responsibilities With Separated by Comma">' . $row['responsibilities'] . '</textarea>
        <h4>Enter Job Eligibilities</h4>
        <textarea required name="eligibilities" id="eligibilities"
            placeholder="Enter Job Eligibilities With Separated by Comma">' . $row['eligibilities'] . '</textarea>
        <h4>Enter Job Benefits</h4>
        <textarea required name="benefits" id="benefits"
            placeholder="Enter Job Benefits With Separated by Comma">' . $row['benefits'] . '</textarea>
        <button >Update</button>
    </form>

        ';
                    if ($row['type'] == 'job') {
                        echo '<script defer>  
                        setTimeout(()=>{
                            toggleBetweenJobAndInternshipInputs(1)
                            document.getElementById("type1").checked=true;
                        },1000)
                        </script>';
                    }else{
                        echo '<script defer>  
                        setTimeout(()=>{
                            toggleBetweenJobAndInternshipInputs(2)
                            document.getElementById("type2").checked=true;
                        },1000)
                        </script>';
                    }
                }
            }
            ?>

            <div>
                <h1>Job Description
                    <?php
                    echo $_SESSION['Company'] ?></span>
                </h1>
                <aside></aside>
            </div>
        </section>
    </div>

</main>
<script>
    setTimeout(()=>{

    },2000)
</script>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/end.php");
?>