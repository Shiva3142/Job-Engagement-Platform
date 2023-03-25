<?php
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/start.php");
if (isset($_SESSION['Id']) && isset($_SESSION['Username'])) {
    header("location:/Components/Home");
} else {
}
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/Header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/Config/DB_connect.php");
?>


<main class="HomePageContainer">
    <section class="introSection" id="introSection">
        <h1>
            Welcome to Our Job Engagement Platform
        </h1>
        <p>Here, you will find different types of Job and Internship opportunities Posted by best Organizations</p>


        <button><a href="/Components/Jobs">See Jobs</a></button>
    </section>
    <section class="facilities" style="flex-wrap: wrap;">
        <h1 class="centered-main-heading">We Provides</h1>
        <div>
            <div class="facility">
                <i class="fas fa-briefcase"></i>
                <h1><a href="/Components//Jobs?job_type=full_time"> Full Time Job Opportunities</a></h1>
            </div>
            <div class="facility">
                <i class="fas fa-scroll"></i>
                <h1><a href="/Components//Jobs?job_type=internship"> Paid Internship Opportunities</a></h1>
            </div>
        </div>
    </section>

    <section class="AdminPosts" style="background:white">
        <h1 class="centered-main-heading">Recent Job Posts</h1>

        <?php

        $search_sql = "SELECT * FROM jobs LIMIT 10";
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


    <section class="facilities" style="flex-wrap: wrap-reverse;">
        <div>
            <div class="facility">
                <i class="fas fa-comment-alt"></i>
                <h1>Messaging System for Communication</h1>
            </div>
            <div class="facility">
                <i class="fas fa-bolt"></i>
                <h1>Easy To Apply System for Internship</h1>
            </div>
        </div>
        <h1 class="centered-main-heading">We Have</h1>
    </section>

    <section class="JobPosters">
        <h1 class="centered-main-heading">Some of Organizations, Who are Posted Jobs here</h1>
        <div>
            <img src="https://blogs.microsoft.com/wp-content/uploads/prod/2012/08/8867.Microsoft_5F00_Logo_2D00_for_2D00_screen.jpg"
                alt="">
            <img src="https://bucket-img.tnlmedia.com/cabinet/files/consoles/1/teams/1/2022/10/VK0vPA7T2NjDpQRxGeGKsG2IWV0Kd6979MMa7Ho5.jpg?auto=compress&fit=crop&h=630&w=1200" alt="">
            
            <img src="https://zeevector.com/wp-content/uploads/Tata-Company-Symbol-Colour.png" alt="">

        </div>
    </section>

</main>

<?php
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/end.php");
?>


<?php
mysqli_close($conn);
?>