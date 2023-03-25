<?php
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/start.php");
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/Header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/Config/DB_connect.php");
?>

<main class="JobPageContainer">
    <section class="JobsContainer">
        <div class="filters">
            <h2 style="text-align: center;">Filters</h2>
            <p>Type of Job</p>
            <div class="options">
                <div class="option" id="jobOption1" onclick="addJobType('jobOption1')">
                    Internship
                </div>
                <div class="option" id="jobOption2" onclick="addJobType('jobOption2')">
                    Full Time Job
                </div>
            </div>
            <p>Salary Range</p>
            <div class="options">
                <div class="option" id="minSalary1" onclick="addMinSalary('minSalary1',5000)">
                    >5000
                </div>
                <div class="option" id="minSalary2" onclick="addMinSalary('minSalary2',10000)">
                    >10000
                </div>
                <div class="option" id="minSalary3" onclick="addMinSalary('minSalary3',15000)">
                    >15000
                </div>
                <div class="option" id="minSalary4" onclick="addMinSalary('minSalary4',20000)">
                    >20000
                </div>
                <div class="option" id="minSalary5" onclick="addMinSalary('minSalary5',25000)">
                    >25000
                </div>
                <div class="option" id="minSalary6" onclick="addMinSalary('minSalary6',50000)">
                    >50000
                </div>
                <div class="option" id="minSalary7" onclick="addMinSalary('minSalary7',75000)">
                    >75000
                </div>
            </div>
            <p>Location of job</p>
            <input type="text" name="location" id="location" placeholder="Enter Location">
            <button type="submit" onclick="applyTheFilters()">Apply</button>
        </div>
        <div class="jobPosts">
            <?php
            $search_sql = "SELECT * FROM jobs";
            $isInserted = false;
            if (isset($_GET['job_type'])) {
                if (strcmp($_GET['job_type'],'internship')==0) {
                    $search_sql = $search_sql." WHERE type='internship' ";
                } else {
                    $search_sql = $search_sql." WHERE type='job' ";
                }
                $isInserted = true;
            }
            if (isset($_GET['min_salary'])) {
                if ($isInserted) {
                    $search_sql = $search_sql ." AND (monthly_pay>=" . $_GET['min_salary'] . " OR package*100000>=".$_GET['min_salary']." )";
                } else {
                    $search_sql = $search_sql ." WHERE (monthly_pay>=" . $_GET['min_salary'] . " OR package*100000>=".($_GET['min_salary']*12).") ";
                }
                $isInserted = true;
            }
            if (isset($_GET['location'])) {
                if ($isInserted) {
                    $search_sql = $search_sql ." AND place LIKE '%" . $_GET['location'] . "%' ";
                } else {
                    $search_sql = $search_sql ." WHERE place LIKE '%" . $_GET['location'] . "%' ";
                }
            }
            $search_sql = $search_sql . " LIMIT 25";
            // echo $search_sql;
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



        </div>


    </section>



    <?php



    ?>


</main>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/end.php");
?>




<?php
mysqli_close($conn);
?>