User_Account
<main>

    <style>
        .AccountDataContainer {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .details {
            color: black;
            margin: 0 auto;
            min-width: 50%;
            padding: 20px;
            max-width: 99%;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
        }

        @media screen and (max-width: 768px) {
            .details {
                min-width: 100%;
                font-size: 0.6em;
            }
        }
    </style>

    <div class="AccountDataContainer">
        <?php
        include($_SERVER["DOCUMENT_ROOT"] . "/Config/DB_connect.php");
        $sql = "SELECT * FROM `job_seekers` WHERE `id` = '" . $_SESSION['Id'] . "'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        echo '

<h1 class="centered-main-heading">Your Details</h1>
<div class="details">
    <h1>Name: <span class="color-blue">' . $row['name'] . '</span></h1>
    <h1>Email: <span class="color-gray">' . $row['email'] . '</span></h1>

    <h1>Phone: <span class="color-gray">' . $row['number'] . '</span></h1>

</div>

';




        ?>




    </div>

    <section class="jobPosts" style="background:white">
        <h1 class="centered-main-heading">Hiring Status</h1>
        <?php
        $search_sql = "SELECT * FROM applications as a, jobs as b where a.job_id=b.job_id and a.applicant_id='" . $_SESSION['Id'] . "' and a.status='hired';";
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
                                    echo '
                            </div>
                        </div>            
            ';
                }
            } else {
                echo '
                <div class="NotFoundContainer">
                <h1>Sorry, You are Not Hired Yet in any Company</h1>
                <div>.·´¯`(>▂<)´¯`·. </div>
            </div>
                ';
            }
        } else {
        }
        ?>
    </section>

</main>