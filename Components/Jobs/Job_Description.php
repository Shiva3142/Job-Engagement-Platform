<?php
    include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/start.php");
    include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/Header.php");
?>
<main>
<?php
    if (isset($_GET['job_id'])) {
    } else {
        header("location:/");
    }
    $job_data = array();

    include($_SERVER["DOCUMENT_ROOT"] . "/Config/DB_connect.php");
    $search_sql = "SELECT * FROM jobs WHERE job_id='" . $_GET['job_id'] . "'";
    $result = mysqli_query($conn, $search_sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
        <div class="jobDescriptionContainer">
        <div class="jobDetails">
            <h1 class="text-align-center">';
            echo $row['position_name'];
            echo '
        </h1>
        <h3 class="text-align-center">';
            echo $row['company_name'];

            echo '
        </h3>
        <h4 class="text-align-center">';
            echo $row['place'];

            echo '
        </h4>
        <div class="jobValuesContainer">
            <div class="value" style="background:blue;color:white">';
            if ($row['type'] == 'internship') {
                echo '<h3><span class="light-text"> Stipend:</span> ' . $row['monthly_pay'] . '/Month</h3>';
            } else {
                echo '<h3><span class="light-text"> Package:</span> ' . $row['package'] . ' LPA</h3>';
            }
            echo '
            </div>
 ';
            if ($row['type'] == 'internship') {
                echo '           <div class="value">
            <h5><span class="light-text"><i class="far fa-hourglass"></i>  Duration:</span> ' . $row['time_range'] . '</h5>      </div>';
            }
            echo '
       
        </div>
        <div class="jobValuesContainer">
        <div class="value" style="background:#00800022"> Posted on: ' . $row['posting_date'] . '
        
        </div>
        <div class="value" style="background:#ff000022"> Last Date of Application: ' . $row['last_date_to_apply'] . '
        
        </div>
        <div class="value" style="background:#80808022"> Number off Applications: ' . $row['number_of_applicants'] . '

        </div>
        
        </div>
        <div class="jobValuesContainer">
            <div class="value"> Number of Positions: ' . $row['number_of_positions'] . '

            </div>
            <div class="value"> job level: ' . $row['job_level'] . '

            </div>
            <div class="value"> Type: ' . $row['type'] . '

            </div>

        </div>


<div class="details">

<ul>
            Skills Required';
            $skill = explode(",", $row['skills_required']);
            foreach ($skill as $value) {
                echo '<li>' . $value . '</li>';
            }
            echo '</ul>
        <ul>
            Responsibilities';
            $skill = explode(",", $row['responsibilities']);
            foreach ($skill as $value) {
                echo '<li>' . $value . '</li>';
            }
            echo '</ul>
        <ul>
            Eligibility';
            $skill = explode(",", $row['eligibilities']);
            foreach ($skill as $value) {
                echo '<li>' . $value . '</li>';
            }
            echo '</ul>
        <ul>
            Benefits';
            $skill = explode(",", $row['benefits']);
            foreach ($skill as $value) {
                echo '<li>' . $value . '</li>';
            }
            echo '</ul>
        
        </div>';
            if ($row['is_active'] == 1) {

                if (isset($_SESSION['Id']) && isset($_SESSION['Username']) && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == false) {




                    $sql = "SELECT * FROM applications WHERE job_id='" . $_GET['job_id'] . "' AND applicant_id='" . $_SESSION['Id'] . "'";
                    $result_check = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result_check) > 0) {
                        echo '

                    <button>Already Applied</button>
        
                    ';
                    } else {

                        echo '<button class="apply_button" onclick="document.getElementById(';

                        echo "'applicationForm').style.display='flex'";

                        echo '">Apply Now</button>
    
                ';
                    }

                } else {
                    echo '

                <button>Login First</button>
    
                ';

                }

            } else {
                echo '

            <button>Job Expired</button>

            ';
            }



            echo '</div>
            
            
            
            
            
            
        
        ';







        }
    } else {
        header("location:/");
    }

    ?>


    <div class="applicationForm" id="applicationForm">
        <form action="/Components/Jobs/Apply.php" method="POST" enctype="multipart/form-data">
            <h1 class="centered-main-heading">
                Application Form
            </h1>
            <h1>Name: SHIVKUMAR CHAUHAN</h1>
            <p>Contact Details</p>
            <h2>Email: PANKAJSINGHAT95@GMAIL.COM</h2>
            <h2>NUMBER: 8879476264</h2>
            <p>Resume</p>
            <input type="text" name="job_id" value="<?php
            echo $_GET['job_id'];
            ?>">
            <h3 class="text-align-center">Upload Your Resume Here</h3>
            <label for="file" id="fileLabel">
                Select Your Resume
            </label>
            <input type="file" onchange="updateFileLabel(event)" name="file" id="file" placeholder="Upload File here"
                required>
            <button type="submit">Submit</button>
        </form>

    </div>


    </div>






</main>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/end.php");
?>