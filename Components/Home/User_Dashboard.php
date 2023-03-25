<?php
if (isset($_SESSION['Id']) && isset($_SESSION['Username']) && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == false) {
} else {
    header("location:/");
}
include($_SERVER["DOCUMENT_ROOT"] . "/Config/DB_connect.php");
?>

<main class="userDashboard">
    <article>
        <h1>
            Hello <span class="color-green">
                <?php
                echo $_SESSION['Username'] ?>
            </span>
        </h1>
        <h2>Manage Your Applied Applications Here</h2>
    </article>
    <section class="jobApplicationsList" style="background:white">
        <!-- <h1 class="centered-main-heading">Newly Arrived Job Posts</h1> -->
        <div class="applicationPreview">


        </div>
    </section>
    <section class="jobPosts" style="background:white">
        <h1 class="centered-main-heading">Your Applied Applications</h1>

        <?php

        $search_sql = "SELECT * FROM applications as a, jobs as b where a.job_id=b.job_id and a.applicant_id='".$_SESSION['Id']."';";
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
                <button><a href="/Components/Jobs/Application.php?application_id=' . $row['application_id'] . '">View Application</a></button>';
                if ($row['status'] == "hired") {
                    echo'<h1 class="text-align-center color-green">Application is Accepted</h1>';
                    
                } else if($row['status'] == "rejected"){
                    echo'<h1 class="text-align-center color-red">Application is Rejected</h1>';
                    
                }else{
                    if ($row['is_viewed'] == 1) {
                        echo '<h3 class="color-red"> HR Manager has Viewed Your Application  </h3>';
                        if ($row['chat_link'] == "not_available") {
                            echo '<h3 class="color-gray"> Soon they can contact</h3>';
                        } else {
                            echo ' <button><a href="/Components/Jobs/Job_Description.php?job_id=' . $row['job_id'] . '">Go to chat</a></button>';
                        }
                    } else {
                        echo '<h3 class="color-gray"> Not Viewed Yet</h3>';
                    }
        
                }

                echo'
            </div>
        </div>            
            ';
                }

            } else {
                echo '
                <div class="NotFoundContainer">
                <h1>Sorry, You Have Not applied Any Opportunity Yet</h1>
                <div>.·´¯`(>▂<)´¯`·. </div>
            </div>
                ';
            }
        } else {
        }
        ?>
    </section>
    <section class="jobPosts" style="background:white">
        <h1 class="centered-main-heading">Newly Arrived Job Posts</h1>

        <?php

        $search_sql = "SELECT * FROM jobs LIMIT 3";
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
                <button><a href="/Components/Jobs/Job_Description.php?job_id=' . $row['job_id'] . '">View This Job</a></button>


            </div>
        </div>            
            ';
                }

            } else {
                echo '
                <div class="NotFoundContainer">
                <h1>Sorry, No Opportunities Found</h1>
                <div>.·´¯`(>▂<)´¯`·. </div>
            </div>
                ';
            }
        } else {
        }
        ?>
    </section>

</main>