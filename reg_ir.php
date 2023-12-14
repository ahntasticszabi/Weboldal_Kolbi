<?php
    session_start();

    print_r($_POST);

    include("adbkapcsolat.php");

    if($_POST['unev']=="")  die("<script> alert('Nem adtad meg a felhasználónevedet!')</script>");
    if($_POST['umail']=="")  die("<script> alert('Nem adtad meg az e-mail címed!')</script>");

    if(strlen($_POST['pw1'])<4)  die("<script> alert('Jelszavad túl rövid!')</script>");
    if($_POST['pw1']!=$_POST['pw2'])  die("<script> alert('Jelszavaid nem egyeznek')</script>");

    if(mysqli_num_rows(mysqli_query($adb, "SELECT * FROM user WHERE unev = '$_POST[unev]'")))
    die("<script> alert('Ez a felhasználó név már foglalt!')</script>");

    if(mysqli_num_rows(mysqli_query($adb, "SELECT * FROM user WHERE umail = '$_POST[umail]'")))
    die("<script> alert('Ezzel az e-mail címmel már regisztráltál!')</script>");

    $upw    = md5($_POST['pw1']);
    $str10  = randomstring();
    mysqli_query($adb, "
            INSERT INTO user    (uid ,  unev,           umail,              upw,            uip,                udatum, ustatusz, ukomment, ujog, ustrid        ) 
            VALUES              (NULL,  '$_POST[unev]', '$_POST[umail]',    '$upw',  '$_SERVER[REMOTE_ADDR]',   NOW(),  'A',      '',       '',   '$str10'      );
    ");

    mysqli_close($adb);

    print "<script> 
                alert('Köszönjük regisztrációdat')
                parent.location.href='./?p=login'
            </script>
    ";
?>