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
        <h1 class="centered-main-heading">Newly Arrived Job Posts</h1>

        <?php

        $search_sql = "SELECT * FROM jobs LIMIT 5";
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
                <button><a href="/Components/Jobs/Job_Description.php?job_id=' . $row['job_id'] . '">Manage This Job</a></button>
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