<?php
    session_start();

    print_r($_POST);

    include("adbkapcsolat.php");

    if($_POST['user']=="")  die("<script> alert('Nem adtad meg az azonosítódat')</script>");

    $upw = md5($_POST['pw']);
    
    $t = mysqli_query($adb, "
            SELECT  * FROM user
            WHERE   (unev='$_POST[user]' OR umail='$_POST[user]') 
            AND     upw = '$upw'
            AND     ustatusz = 'A'
    ");

    if(mysqli_num_rows($t))
    {
        $sor = mysqli_fetch_array($t);

        $_SESSION['uid']    =   $sor['uid'];
        $_SESSION['unev']   =   $sor['unev'];
        $_SESSION['umail']  =   $sor['umail'];
        $_SESSION['upw']    =   $sor['upw'];
        $_SESSION['ujog']   =   $sor['ujog'];

        mysqli_query($adb, "
            INSERT INTO login    (lid ,     luid,            ldatum,    lip) 
            VALUES              ('',      '$sor[uid]',  NOW(),     '$_SERVER[REMOTE_ADDR]');
        ");
        $_SESSION['lid']    =   mysqli_insert_id($adb);

        print "
            <script>
                parent.location.href='./'
            </script>
        ";

        
    }
    else 
    {
        die("<script> alert('Hibás belépési adatok!')</script>");
    }

    mysqli_close($adb);

?>