<?php

    //清除Session
    function clearSession(){

        //先判斷session是否存在
        if(!isset($_SESSION)){
            session_start(); 
        }

        session_unset();
        session_destroy();

    }

    //--------------------------------------後台專用--------------------------------------

    //取得Session(後台專用)
    function getSessionB(){

        //先判斷session是否存在
        if(!isset($_SESSION)){
            session_start(); 
        }

        //有登入session->回傳ID，無登入session->回傳空字串""
        // return isset($_SESSION["BACKSTAGE_MEMBER"]) ? $_SESSION["BACKSTAGE_MEMBER"] : ""; 
        if (isset($_SESSION["BACKSTAGE_MEMBER"]) && isset($_SESSION["Permissions"])) {
            // 返回 $_SESSION["BACKSTAGE_MEMBER"] 和 $_SESSION["Permissions"] 的值
            return array($_SESSION["BACKSTAGE_MEMBER"], $_SESSION["Permissions"]);
        } else {
            // 若其中一個或兩個 SESSION 變數不存在，則回傳空陣列
            return '';
        }            

    }

    //寫入Session(後台專用)
    function setSessionB($UserID,$Permissions,$Status){

        //先判斷session是否存在
        if(!isset($_SESSION)){
            session_start(); 
        }

        $_SESSION["BACKSTAGE_MEMBER"] = $UserID;
        $_SESSION["Permissions"] = $Permissions;
        $_SESSION["Status"] = $Status;

    }

    //--------------------------------------前台專用--------------------------------------

    //取得會員ID(前台專用)
    function getMemberAccount(){

        //先判斷session是否存在
        if(!isset($_SESSION)){
            session_start(); 
        }

        //有登入session->回傳ID，無登入session->回傳空字串""
        return isset($_SESSION["Account"]) ? $_SESSION["Account"] : ""; 

    }

    //取得會員帳號(前台專用)
    function getMemberName(){

        //先判斷session是否存在
        if(!isset($_SESSION)){
            session_start(); 
        }

        //有登入session->回傳Name，無登入session->回傳空字串""
        return isset($_SESSION["MemberAccount"]) ? $_SESSION["MemberAccount"] : ""; 

    }

    //寫入Session(前台專用)
    function setMemberInfo($MemberAccount, $MemberStatus,$MemberId){

        //先判斷session是否存在
        if(!isset($_SESSION)){
            session_start(); 
        }

        //Table 'ec_member'裡的ID欄位值
        $_SESSION["MemberAccount"] = $MemberAccount; 

        //Table 'ec_member'裡的Account欄位值
        $_SESSION["MemberStatus"] = $MemberStatus; 

        $_SESSION["MemberId"] = $MemberId; 
        
    }

?>