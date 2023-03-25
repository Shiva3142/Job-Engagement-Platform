<header>
    <h1>
        <a href="/"><i class="fas fa-book"></i> Job Engagement Platform</a>
    </h1>
    <nav class="desktopNav">
        <a href="/Components/Jobs">Opportunities</a>
        <a href="/Components//Jobs?job_type=internship">Internships</a>
    </nav>
    <?php
    if (isset($_SESSION['Id']) && isset($_SESSION['Username'])) {
        if ($_SESSION['isAdmin']==true) {
            echo'
            <button>Recruiter Account</button>
            ';
        }else{
            echo'
            <button>Job Seeker Account</button>
            ';
        }
        echo '
        <div class="headerLoginOptions" onclick="toggleHeaderLoginOptions()">

            <span>Hello
                ' . $_SESSION['Username'] . '
            </span>
            <div id="headerLoginOptions">
                <a href="/Components/Account">Account</a>
                <a href="/Components/Login/Logout.php">Logout</a>
            </div>
        </div>
            ';
    } else {
        echo '
        <a href="/Components/Login"><button>Login</button></a>
            ';
    }
    ?>
</header>