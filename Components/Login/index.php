<?php
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/start.php");
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/Header.php");
if (isset($_SESSION['Id']) && isset($_SESSION['Username'])) {
    header("location:/");
}


if (isset($_SESSION['isError']) && isset($_SESSION['ErrorMessage']) && isset($_SESSION['ErrorIsFor'])) {
    $error_options = explode("|", $_SESSION['ErrorIsFor']);
    if ($error_options[0] == 'USER') {
        if ($error_options[1] == 'LOGIN') {
            echo '
            <script>
            window.onload=function () {
                toggleUserAndAdminLogin(1)
                toggleUserLoginAndRegister(1)
            }
            </script>
            ';
        } else {
            echo '
            <script>
            window.onload=function () {
                toggleUserAndAdminLogin(1)
                toggleUserLoginAndRegister(2)
            }
            </script>
            ';
        }
    } else {
        if ($error_options[1] == 'LOGIN') {
            echo '
            <script>
            window.onload=function () {
                toggleUserAndAdminLogin(2)
                toggleAdminLoginAndRegister(1)
            }
            </script>
            ';
        } else {
            echo '
            <script>
            window.onload=function () {
                toggleUserAndAdminLogin(2)
                toggleAdminLoginAndRegister(2)
            }
            </script>
            ';
        }
    }
    echo '
    <div id="notifications" style="background-color: red;">
    <div>
    '.$_SESSION["ErrorMessage"].'
    </div>
    <i class="fas fa-times" onclick="hideNotificationBar()"></i>
</div>
    ';
    unset($_SESSION["isError"]);
    unset($_SESSION["ErrorMessage"]);
    unset($_SESSION["ErrorIsFor"]);
    session_destroy();
}

?>
<main class="LoginPageContainer" id="defaultLoginOptions">
    <section>
        <div style="background-color: #0984e3" onclick="toggleUserAndAdminLogin(1)">
            Login For <span class="color-red"> Job Seekers</span>
        </div>
        <div style="background-color: #192a56" onclick="toggleUserAndAdminLogin(2)">
            Login For <span class="color-gray">Hiring Admins</span>
        </div>
    </section>
</main>
<main class="LoginPageContainer" id="userLogin">
    <h4 class="color-green" style="font-weight: bolder; width: 300px;margin: 20px; text-decoration: underline;"><i
            class="fas fa-arrow-left" onclick="toggleUserAndAdminLogin(2)"> Go to Admin Login</i></h4>
    <form action="./User_Login.php" id="user_form_1" method="post">
        <h1>User Login</h1>
        <input type="email" name="email" id="email" placeholder="Enter Email" required>
        <input type="password" name="password" id="password" placeholder="Enter Password" required>
        <button type="submit">Login</button>
        <p>New User, Click here to <span class="color-red" style="text-decoration: underline;"
                onclick="toggleUserLoginAndRegister(2)">Register</span></p>
    </form>
    <form action="./User_Register.php" id="user_form_2" method="post">
        <h1>User Registration</h1>
        <input type="text" name="name" id="name" placeholder="Enter Name" required>
        <input type="email" name="email" id="email" placeholder="Enter Email" required>
        <input type="number" name="phone" id="phone" placeholder="Enter Phone" required>
        <input type="password" name="password" id="password" placeholder="Enter Password" required>
        <button type="submit">Register</button>
        <p>Registered Already, Click here to <span class="color-red" style="text-decoration: underline;"
                onclick="toggleUserLoginAndRegister(1)">Login</span></p>
    </form>
</main>
<main class="LoginPageContainer" id="adminLogin">
    <h4 class="color-green" style="font-weight: bolder; width: 300px;margin: 20px; text-decoration: underline;"><i
            class="fas fa-arrow-left" onclick="toggleUserAndAdminLogin(1)"> Go to User Login</i> </h4>
    <form action="./Admin_Login.php" id="admin_form_1" method="post">
        <h1>Admin Login</h1>
        <input type="email" name="email" id="email" placeholder="Enter Email" required>
        <input type="password" name="password" id="password" placeholder="Enter Password" required>
        <button type="submit">Login</button>
        <p>New User, Click here to <span class="color-red" style="text-decoration: underline;"
                onclick="toggleAdminLoginAndRegister(2)">Register</span></p>
    </form>
    <form action="./Admin_Register.php" id="admin_form_2" method="post">
        <h1>Admin Registration</h1>
        <input type="text" name="name" id="name" placeholder="Enter Name" required>
        <input type="text" name="company" id="company" placeholder="Enter Company Name" required>
        <input type="email" name="email" id="email" placeholder="Enter Email" required>
        <input type="number" name="phone" id="phone" placeholder="Enter Phone" required>
        <input type="password" name="password" id="password" placeholder="Enter Password" required>
        <button type="submit">Register</button>
        <p>Registered Already, Click here to <span class="color-red" style="text-decoration: underline;"
                onclick="toggleAdminLoginAndRegister(1)">Login</span></p>
    </form>
</main>


<?php
include($_SERVER["DOCUMENT_ROOT"] . "/Components/Templates/defaults/end.php");
?>