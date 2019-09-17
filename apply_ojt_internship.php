<?php
    // Start session.
    session_start();
    
    // Get session data.
    $session_is_login     = isset($_SESSION['is_login'])     ? $_SESSION['is_login']     : 0;
    $session_id_user      = isset($_SESSION['id_user'])      ? $_SESSION['id_user']      : 0;
    $session_id_user_type = isset($_SESSION['id_user_type']) ? $_SESSION['id_user_type'] : 0;
    
    // Assess session flags.
    $session_flag_is_login     = ($session_is_login > 0);
    $session_flag_id_user      = ($session_id_user > 0);
    $session_flag_id_user_type = ($session_id_user_type < 5 && $session_id_user_type > 0);
    
    // Proceed if session flags are true.
    if ($session_flag_is_login && $session_flag_id_user && $session_flag_id_user_type) {
        // Proceed according to user type id.
        switch ($session_id_user_type) {
            case 1:
                // Redirect to student home page and exit script.
                header('Location:./user_student');
                exit();
                break;
            case 2:
                // Redirect to company home page and exit script.
                header('Location:./user_company');
                exit();
                break;
            case 3:
                // Redirect to adviser home page and exit script.
                header('Location:./user_adviser');
                exit();
                break;
            case 4:
                // Redirect to admin home page and exit script.
                header('Location:./user_admin');
                exit();
                break;
        }
    }
    
    // Destroy session.
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>LPU OJT PORTAL - Apply OJT Internship</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="./assets/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="./assets/images/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
        <script src="./assets/js/jquery-3.1.1.min.js"></script>
        <script src="./assets/js/tether.min.js"></script>
        <link rel="stylesheet" href="./assets/css/lpuojtportal.css">
    </head>
    <body background="./assets/images/portal_bg.png">
        <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
            <a href="./index.php">
                <img class="navbar-brand" src="./assets/images/portal_logo.png" width="50px" height="58px"/>
            </a>
        </nav>
        <div class="container-fluid">
            <div class="portal-content">
                <div class="row">
                    <div class="col text-center">
                        <img src="./assets/images/portal_logo.png" width="96px" height="96px" />
                    </div>
                </div>
                <div class="row" style="margin-top:16px">
                    <div class="col text-center">
                        <p class="h3">Select Login</p>
                    </div>
                </div>
                <form action="./apply_ojt_internship.php" method="POST" style="margin-top:16px">
                    <div class="form-row row">
                        <label class="h6" for="auth_user">Username</label>
                        <input class="form-control" type="text" name="auth_user" id="auth_user" placeholder="Enter username" required autofocus />
                    </div>
                    <div class="form-row row" style="margin-top:8px">
                        <label class="h6" for="auth_pass">Password</label>
                        <input class="form-control" type="password" name="auth_pass" id="auth_pass" placeholder="Enter password" required />
                    </div>
                    <div class="form-row row" style="margin-top:8px">
                        <label class="h6" for="auth_pass_confirm">Confirm Password</label>
                        <input class="form-control" type="password" name="auth_pass_confirm" id="auth_pass_confirm" placeholder="Enter password" required />
                    </div>
                    <div class="form-row row" style="margin-top:8px">
                        <label class="h6" for="auth_sec_q1">Security Quesiton #1</label>
                        <input class="form-control" type="text" name="auth_sec_q1" id="auth_sec_q1" placeholder="Enter security question" required autofocus />
                    </div>
                    <div class="form-row row" style="margin-top:8px">
                        <label class="h6" for="auth_sec_a1">Answer</label>
                        <input class="form-control" type="text" name="auth_sec_a1" id="auth_sec_a1" placeholder="Enter answer" required autofocus />
                    </div>
                    <div class="form-row row" style="margin-top:8px">
                        <label class="h6" for="auth_sec_q2">Security Quesiton #2</label>
                        <input class="form-control" type="text" name="auth_sec_q2" id="auth_sec_q2" placeholder="Enter security question" required autofocus />
                    </div>
                    <div class="form-row row" style="margin-top:8px">
                        <label class="h6" for="auth_sec_a2">Answer</label>
                        <input class="form-control" type="text" name="auth_sec_a2" id="auth_sec_a2" placeholder="Enter answer" required autofocus />
                    </div>
                    <div class="form-row row" style="margin-top:16px">
                        <div class="col-6">
                            <a class="btn btn-primary" href="./login_student.php">Go Back</a>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-primary">Apply</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>