<main>
    <?php
    include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/start.php");
    include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/Header.php");


    if (isset($_GET['application_id']) && isset($_SESSION['Id']) && isset($_SESSION['Username'])) {
    } else {
        header("location:/");
    }
    $job_data = array();

    include($_SERVER["DOCUMENT_ROOT"] . "/Config/DB_connect.php");
    $search_sql = "SELECT * FROM jobs as a,applications as b, job_seekers as c where a.job_id=b.job_id and b.applicant_id=c.id AND b.application_id='" . $_GET['application_id'] . "'";
    $result = mysqli_query($conn, $search_sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['applicant_id'] != $_SESSION['Id'] and $row['admin_Id'] != $_SESSION['Id']) {
                header("location:/");
            }
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
            </div> ';
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
        ';
        if ($row['is_viewed'] == 1) {
        } else {
            echo '<h3 class="color-gray"> Not Viewed Yet</h3>';
        }



        echo'
        <div class="applicantDetails">
            
        <h1>Name: ' . $row['name'] . '</h1>
        <p>Contact Details</p>
        <h2>Email: ' . $row['email'] . '</h2>
        <h2>NUMBER: ' . $row['number'] . '</h2>
        <p>Resume</p>';
        if ($row['status'] == "hired") {
            echo'<h1 class="text-align-center color-green">Application is Accepted</h1>';
            
        } else if($row['status'] == "rejected"){
            echo'<h1 class="text-align-center color-red">Application is Rejected</h1>';
            
        }else{
            echo'<h1 class="text-align-center color-gray">Yet, No Action is performed on this application</h1>';

        }
        


        echo'<a href="' . $row['resume_file_location'] . '" class="resume" download>
        <embed src="' . $row['resume_file_location'] . '" width="800px" height="2100px" />
        
        <div >
            <h2>Download Resume</h2>
        </div>
        
        </a>
        </div>

<div class="details">
        
        </div>';
            if ($row['is_active'] == 1) {

            } else {
                echo '

            <button>Job Expired</button>

            ';
            }



            if ($row['admin_Id'] == $_SESSION['Id']) {
                $sql_update="UPDATE applications SET is_viewed=1 WHERE application_id=".$row['application_id'];
                $result_update=mysqli_query($conn, $sql_update);


                echo '
                <button style="background:blue;">
                
                
                Start Chat
                
                
                </button>
                <button style="background:green;">
                
                <a href="/Components/Jobs/Hire.php?application_id='.$_GET['application_id'].'">
                Hire Candidate
                </a>
                
                </button>
                <button style="background:red;">
                
                <a href="/Components/Jobs/Reject.php?application_id='.$_GET['application_id'].'">
                Reject Application
                </a>
                
                </button>
                
                
                ';
            }

            echo '
            
            
            
            </div>
            
            
        
        ';

        }
    } else {
        header("location:/");
    }

    ?>



    </div>






</main>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/end.php");
?>