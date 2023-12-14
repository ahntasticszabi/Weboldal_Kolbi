<?php
    session_start();

    print_r($_POST);

    if($_POST['upw'] =="")              die("<script> alert('Nem adtad meg a jelszavad!')</script>");

    include("adbkapcsolat.php");

    if(strlen($_POST['pw1'])<4)         die("<script> alert('Jelszavad túl rövid!')</script>");
    if($_POST['pw1']!=$_POST['pw2'])    die("<script> alert('Jelszavaid nem egyeznek')</script>");
   
    $user = mysqli_fetch_array(mysqli_query($adb, "SELECT upw FROM user WHERE ustrid='$_POST[ustrid]'"));
    if(md5($_POST['upw'])!=$user['upw'])  
    die("<script> alert('Hibás jelszó!')</script>");
    
    $upw    = md5($_POST['pw1']);

    $t = mysqli_query($adb, "
            UPDATE  user
            SET     upw    =    md5('$_POST[pw1]')
            WHERE   ustrid  =   '$_POST[ustrid]'
    ");

    print "
        <script>
            alert('A jelszavad módosítása megtörtént.')
        </script>
    ";


    mysqli_close($adb);

?>