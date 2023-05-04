<?php
    // 啟動 Session
    session_start();

    // 清除 Session 中的資訊
    $_SESSION = array();

    // 刪除 Session ID 的 Cookie
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }

    // 銷毀 Session
    session_destroy();

    // $URL="login.html"; 
    // header("Location: $URL");
?>