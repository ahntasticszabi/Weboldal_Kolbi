<?php
    session_start();

    print_r($_POST);

    if($_POST['unev'] =="")     die("<script> alert('Nem adtad meg a nevedet!')</script>");

    if($_POST['umail']=="")     die("<script> alert('Nem adtad meg az e-mail-címedet!')</script>");

    include("adbkapcsolat.php");

    if(mysqli_num_rows(mysqli_query($adb, "SELECT * FROM user WHERE unev='$_POST[unev]'  AND ustrid!='$_POST[ustrid]'")))
    die("<script> alert('Ez a felhasználó név már foglalt!')</script>");

    if(mysqli_num_rows(mysqli_query($adb, "SELECT * FROM user WHERE umail='$_POST[umail]' AND ustrid!='$_POST[ustrid]'")))
    die("<script> alert('Ezzel az e-mail címmel már regisztráltál!')</script>");

    $user = mysqli_fetch_array(mysqli_query($adb, "SELECT upw FROM user WHERE ustrid='$_POST[ustrid]'"));
    if(md5($_POST['upw'])!=$user['upw'])  
    die("<script> alert('Hibás jelszó!')</script>");
    
    $t = mysqli_query($adb, "
            UPDATE  user
            SET     unev    =   '$_POST[unev]',
                    umail   =   '$_POST[umail]'
            WHERE   ustrid  =   '$_POST[ustrid]'
    ");

    print "
        <script>
            alert('Az adatok módosítása megtörtént.')
            parent.location.href='./?p=profil'
        </script>
    ";


    mysqli_close($adb);

?>