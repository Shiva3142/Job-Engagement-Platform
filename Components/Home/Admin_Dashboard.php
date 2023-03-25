<?php
if (isset($_SESSION['Id']) && isset($_SESSION['Username']) && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
} else {
    header("location:/");
}
include($_SERVER["DOCUMENT_ROOT"] . "/Config/DB_connect.php");
?>

<main class="adminDashboard">
    <article>
        <h1>
            Hello <span class="color-green">
                <?php
                echo $_SESSION['Company'] ?>
            </span>
        </h1>
        <button onclick="showJobAdditionForm()"> <a href="#jobFormContainer"> Post New Job/Internship</a></button>
    </article>
    <section class="jobFormContainer" id="jobFormContainer">
        <form action="Add_Job.php" method="post">
            <h4>Enter Position Name</h4>
            <input required type="text" value="Web Developer" name="position" id="position"
                placeholder="Enter Position Name">
            <h4>Enter Location of Job</h4>
            <input required type="text" name="location" value="Mumbai,India" id="location"
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
                <input required type="radio" name="level" id="level1" value="Fresher">
                <label for="level1">Fresher</label>
                <input required type="radio" name="level" id="level2" value="Intermediate">
                <label for="level2">Intermediate</label>
                <input required type="radio" name="level" id="level3" value="Advanced">
                <label for="level3">Advanced</label>
            </div>
            <h4>Enter Last Date of Application</h4>
            <input required type="date" name="date" id="date" placeholder="Enter Last Date of Application">
            <h4>Enter Number Positions</h4>
            <input required type="number" name="number" value="10" id="number" placeholder="Enter Number Positions">
            <h4 class="month">Enter Number of Months</h4>
            <input type="text" name="month" class="month" value="6 Months" placeholder="Enter Number of Months">
            <h4 class="package">Enter salary Per Annum(in LPA)</h4>
            <input type="text" name="package" class="package" value="10" placeholder="Enter salary Per Annum">
            <h4 class="salary">Enter Salary Per Month</h4>
            <input type="text" name="salary" class="salary" value="25000" placeholder="Enter Salary Per Month">
            <h4>Enter Required Skills</h4>
            <textarea required name="skills" id="skills"
                placeholder="Enter Job Skills With Separated by Comma">Python,Javascript,C,C++,Java,PHP,MERN,ReactJS,NodeJS,Machine Learning</textarea>
            <h4>Enter Job Responsibilities</h4>
            <textarea required name="responsibilities" id="responsibilities"
                placeholder="Enter Job Responsibilities With Separated by Comma">Frontend Development,Backend Development,Data Analytics</textarea>
            <h4>Enter Job Eligibilities</h4>
            <textarea required name="eligibilities" id="eligibilities"
                placeholder="Enter Job Eligibilities With Separated by Comma">Final Year Engineering Student,Available for 6 Months,Can start work from next 10 Days</textarea>
            <h4>Enter Job Benefits</h4>
            <textarea required name="benefits" id="benefits"
                placeholder="Enter Job Benefits With Separated by Comma">Certificate,Letter of Recommendation,Flexible,5 days a Week</textarea>
            <Button>Submit</Button>
        </form>
        <div>
            <h1>Form of Job for
                <?php
                echo $_SESSION['Company'] ?></span>
            </h1>
            <aside></aside>
        </div>
    </section>
    <section class="jobPosts" >
        <h1 class="centered-main-heading">Applications By Job Seekers</h1>

        <?php

        $search_sql = "SELECT * FROM jobs as a,applications as b where a.job_id=b.job_id and a.admin_Id='".$_SESSION['Id']."';";
        $result = mysqli_query($conn, $search_sql);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
        <div class="jobPost">
            <div class="headingSection">
                <h3 class="color-blue">' . $row['position_name'] . '</h3>
                <h5 class="color-gray">' . $row['company_name'] . '</h5>
                <button>' . $row['type'] . '</button>';
                    if ($row['type'] == 'internship') {
                        echo '
                    <h5><span class="light-text"><i class="far fa-hourglass"></i>  Duration:</span> ' . $row['time_range'] . '</h5>';
                    }
                    echo '<p>Applied at ' . $row['time_stamp'] . '</p>
            </div>
            <div class="jobValuesSection">';
                    if ($row['type'] == 'internship') {
                        echo '<h3><span class="light-text"> Stipend:</span> ' . $row['monthly_pay'] . '/Month</h3>';
                    } else {
                        echo '<h3><span class="light-text"> Package:</span> ' . $row['package'] . ' LPA</h3>';
                    }

                    echo '<h4> <i class="fas fa-globe-asia"></i> ' . $row['place'] . '</h4>
                <button style="background:blue;color:white"><a href="/Components/Jobs/Application.php?application_id=' . $row['application_id'] . '">View Application</a></button>';
                if ($row['status'] == "hired") {
                    echo'<h1 class="text-align-center color-green">Application is Accepted</h1>';
                    
                } else if($row['status'] == "rejected"){
                    echo'<h1 class="text-align-center color-red">Application is Rejected</h1>';
                    
                }else{
                    if ($row['is_viewed'] == 1) {
                        echo '<h3 class="color-red"> You have Viewed This Application  </h3>';
                        if ($row['chat_link'] == "not_available") {
                            echo '<h3 class="color-gray"> Soon they can contact</h3>';
                        } else {
                            echo ' <button><a href="/Components/Jobs/Job_Description.php?job_id=' . $row['job_id'] . '">You Have Initiated a Chat</a></button>';
                        }
                    } else {
                        echo '<h3 class="color-gray"> Not Viewed Yet</h3>';
                    }
        
                }

                    echo '
            </div>
        </div>            
            ';
                }

            } else {
                echo '
                <div class="NotFoundContainer">
                <h1>Sorry, No Applications Found</h1>
                <div>.·´¯`(>▂<)´¯`·. </div>
            </div>
                ';
            }
        } else {
        }
        ?>
    </section>
    <h1 class="centered-main-heading">Recent Job Posts</h1>

    <section class="AdminPosts">

        <?php

        $search_sql = "SELECT * FROM jobs WHERE admin_id='" . $_SESSION['Id'] . "';";
        $result = mysqli_query($conn, $search_sql);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
            <div class="jobPost">
            <div class="headingSection">
                <h3 class="color-green">' . $row['position_name'] . '</h3>
                <h5 class="color-gray">' . $row['company_name'] . '</h5>
                <button>' . $row['type'] . '</button>';
                    if ($row['type'] == 'internship') {
                        echo '
                    <h5><span class="light-text"><i class="far fa-hourglass"></i>  Duration:</span> ' . $row['time_range'] . '</h5>';
                    }
                    echo '<p>Posted at ' . $row['posting_date'] . '</p>
            </div>
            <div class="jobValuesSection">';
                    if ($row['type'] == 'internship') {
                        echo '<h3><span class="light-text"> Stipend:</span> ' . $row['monthly_pay'] . '/Month</h3>';
                    } else {
                        echo '<h3><span class="light-text"> Package:</span> ' . $row['package'] . ' LPA</h3>';
                    }

                    echo '<h4> <i class="fas fa-globe-asia"></i> ' . $row['place'] . '</h4>
                <button><a href="/Components/Home/Job_Management.php?job_id=' . $row['job_id'] . '">Manage This Job</a></button>
            </div>
        </div>            
            ';
                }

            } else {
                echo '
        <div class="NotFoundContainer">
        <h1>You Have not Posted Any Opportunity Yet</h1>
        <div>.·´¯`(>▂<)´¯`·. </div>
    </div>
        
        ';
            }
        } else {
        }
        ?>
    </section>
</main>


<?php
mysqli_close($conn);
?>