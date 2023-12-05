<?php 
    session_start();
    session_destroy();
    
    // Unset all session variables
    $_SESSION = array();

    // Delete the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 1, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }

    // Redirect to login.php
    header("Location: login.php");
    exit(); // Make sure to exit after a header redirect
?>
