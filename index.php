<?php
    session_start(); // 開始 Session
    echo "登入狀態:". $_SESSION['login'] ."</br>";
    echo "登入帳號:". $_SESSION['account'] ."</br>";
    echo "登入權限:". $_SESSION['level'] ."</br>";

?>