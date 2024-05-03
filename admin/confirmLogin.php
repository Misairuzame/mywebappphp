<?php
require_once 'db.php';
require_once 'test_input.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        header("Location: login.php?error=username is required");
        die();
    } else {
        $uname = test_input($_POST["username"]);
    }

    if (empty($_POST["password"])) {
        header("Location: login.php?error=password is required");
        die();
    } else {
        $user_password = test_input($_POST["password"]);
    }
} else {
    header("Location: login.php?error=method not allowed", true, 405);
    die();
}

/**
 * Questa è la versione vulnerabile, ci si può
 * loggare con:
 * ' OR 1=1;--
 * e una password qualsiasi
 */
/*
try {
    $conn = connect();
    $pwd = md5($user_password);
    $stmt = $conn->prepare("SELECT username, password FROM admin WHERE username='".$uname."' AND password='".$pwd."'");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($rows)!=1){
        header("Location: login.php?error=Nome utente o password errati");
        die();
    } else {
        $user = $rows[0];
        session_start();
        $_SESSION["uname"] = $uname;
        $tohash = $uname."".$user['password'];
        $hash = hash ( "sha512", $tohash);
        setcookie("logged", $uname.'-'.$hash, time() + (86400 * 30), "/");
        header("Location: home.php");
        die();
    }
} catch(PDOException $e) {
    header("Location: login.php?error=Error: " . $e->getMessage());
}
*/

/**
 * NON VULNERABILE
 */
try {
    $conn = connect();
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=?");
    $stmt->execute(array($uname));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($rows)!=1){
        header("Location: login.php?error=Nome utente o password errati");
        die();
    } else {
        $user = $rows[0];
        if (md5($user_password) == $user['password']){
            session_start();
            $_SESSION["uname"] = $uname;
            $tohash = $uname."".$user['password'];
            $hash = hash ( "sha512" , $tohash);
            setcookie("logged", $uname.'-'.$hash, time() + (86400 * 30), "/");
            header("Location: home.php");
            die();
        } else {
            header("Location: login.php?error=Nome utente o password errati");
            die();
        }
    }
} catch(PDOException $e) {
    header("Location: login.php?error=Error: " . $e->getMessage());
}
