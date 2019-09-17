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
    // session_destroy();
        // Proceed if server request is post otherwise show default page.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $err_msg="YAY";
        // Get post values.
        $post_auth_user   = isset($_POST['auth_user'])   ? $_POST['auth_user']   : '';
        $post_auth_pass   = isset($_POST['auth_pass'])   ? $_POST['auth_pass']   : '';
        $post_remember_me = isset($_POST['remember_me']) ? $_POST['remember_me'] : '';
        $post_submit      = isset($_POST['submit'])      ? $_POST['submit']      : '';
        
        if (!empty($post_remember_me)) {
            // Set cookies user post values which lasts for an hour.
            setcookie('lop_admin_auth_user',   $post_auth_user,   time() + 3600, "/");
            setcookie('lop_admin_auth_pass',   $post_auth_pass,   time() + 3600, "/");
            setcookie('lop_admin_remember_me', $post_remember_me, time() + 3600, "/");
        } else {
            // Empty cookies which lasts for an hour.
            if (isset($_COOKIE['lop_admin_auth_user']))   setcookie('lop_admin_auth_user',   '', time() + 3600, "/");
            if (isset($_COOKIE['lop_admin_auth_pass']))   setcookie('lop_admin_auth_pass',   '', time() + 3600, "/");
            if (isset($_COOKIE['lop_admin_remember_me'])) setcookie('lop_admin_remember_me', '', time() + 3600, "/");
        }
        
    
        include('class/login.php');

        if($login->LoginAuth($post_auth_user,$post_auth_pass)){

            if($login->GetId($post_auth_user,$post_auth_pass)){
                foreach($login->GetId($post_auth_user,$post_auth_pass) as $row){
                    $id = $row['id'];
                    $ss_id = $row['ss_id'];
                    $id_user_type = $row['id_user_type'];
                }
    
                // Store session data.
                $_SESSION['is_login']     = 1;
                $_SESSION['id_user']      = $id;
                $_SESSION['id_user_type'] = $id_user_type;

                $err_msg= $_SESSION['id_user'];

            // Get session data.
            $session_is_login     = isset($_SESSION['is_login'])     ? $_SESSION['is_login']     : 0;
            $session_id_user_type = isset($_SESSION['id_user_type']) ? $_SESSION['id_user_type'] : 0;
            
            // Assess session flags.
            $session_flag_is_login     = ($session_is_login > 0);

            // Proceed if session flags are true.
            if ($session_flag_is_login) {
            // Proceed according to user type id.
            switch ($session_id_user_type) {
                case 1:
                    // $_SESSION['id_user']      = $ss_id;
                    // Redirect to student home page and exit script.
                    header('Location:./user_student');
                    exit();
                    break;
                case 2:
                    // $_SESSION['id_user']      = $ss_id;
                    // Redirect to company home page and exit script.
                    header('Location:./user_company');
                    exit();
                    break;
                case 3:
                    // $_SESSION['id_user']      = $ss_id;
                    // Redirect to adviser home page and exit script.
                    header('Location:./user_adviser');
                    exit();
                    break;
                case 4:
                    // $_SESSION['id_user']      = $ss_id;
                    // Redirect to admin home page and exit script.
                    header('Location:./user_admin');
                    exit();
                    break;
            }
            }
                // Redirect to adviser home page and exit script.
                // header('Location:./user_adviser');
                // exit();

            }
        }else {
         // Destroy session then initialize error message.
            session_destroy();
            $err_msg = "Invalid username specified. Please try again!";
        }
      
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>LPU OJT Portal User Login</title>
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
        <?php
            if (isset($err_msg) && !empty($err_msg)) {
                print('<script type="text/javascript">');
                print('alert("'.$err_msg.'");');
                print('</script>');
            }
        ?>
        <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
            <a href="./index.php">
                <img class="navbar-brand" src="./assets/images/portal_logo.png" width="50px" height="58px"/>
            </a>
            <p class="title">LLLLLLLL</p>
        </nav>
        <div class="container">
            <div class="portal-content">
                <div class="row">
                    <div class="col text-center">
                        <img class="navbar-brand" src="./assets/images/portal_logo.png" width="85px" height="96px"/>
                    </div>
                </div>
                <div class="row" style="margin-top:16px">
                    <div class="col text-center">
                        <p class="h3">LPU OJT PORTAL</p>
                    </div>
                </div>
                <form action="./index.php" method="POST" style="margin-top:16px">
                    <div class="form-row row">
                        <label class="h6" for="auth_user">Username</label>
                        <div class="col-lg-8">    
                        <input class="form-control" type="text" name="auth_user" id="auth_user" placeholder="Enter username" value="<?php if (isset($_COOKIE["lop_admin_login"])) { print($_COOKIE["lop_admin_login"]); } ?>" required autofocus />
                        </div>
                    </div>
                    <div class="form-row row" style="margin-top:8px">
                        <label class="h6" for="auth_pass">Password</label>
                        <div class="col-lg-8">
                        <input class="form-control" type="password" name="auth_pass" id="auth_pass" placeholder="Enter password" value="<?php if (isset($_COOKIE["lop_admin_password"])) { print($_COOKIE["lop_admin_password"]); } ?>" required />
                        </div>
                    </div>
                    <div class="form-row row" style="margin-top:8px">
                        <div class="col-12">
                            <div class="form-check text-center">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="remember_me" <?php if (isset($_COOKIE["lop_admin_remember_me"])) { ?>checked<?php } ?> />&nbsp;Remember Me
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row row" style="margin-top:8px">
                        <div class="col-12 text-center">
                            <a href="#">Forgot your password?</a>
                        </div>
                    </div>
                    <div class="row" style="margin-top:16px">
                        <div class="col-10 btn-index">
                            <button class="btn btn-primaryindex">Login</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </body>
</html>