<?php
        
        include('../../Lib/conn.php');
        include('../../Lib/MemberCheck.php');
        //---------------------------------------------------
        
        //取得登入的帳號
        getMemberName();
        $status=$_SESSION["MemberStatus"];
        echo $status;


?>