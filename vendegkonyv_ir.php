<?php

    session_start();

    print_r($_POST);
    print "<hr>";
    print_r($_FILES);

    if(!file_exists("vendegkonyv.txt")) 
    {
        $fp = fopen("vendegkonyv.txt", "w");
        fclose($fp);
    }

    if($_POST['vendegnev'] == ""){
        die("<script>alert('Nem írtál nevet! \\r\\nÍrj valamit!')</script>");
    }

    if($_POST['uzenet'] == ""){
        die("<script>alert('Nem írtál üzenetet! \\r\\nÍrj valamit!')</script>");
    }

    if($_SESSION['cc'] != $_POST['captcha']){
        die("<script>alert('Nem jól számoltál!($_SESSION[cc] * $_POST[captcha])')</script>");
    }

    $_POST = str_replace(";" , "," , $_POST);
    $_POST = str_replace("<" , "< " , $_POST);
    $uzenet = $_POST['uzenet'];
    $uzenet = str_replace("\r\n" , "<br>" , $uzenet);

    date_default_timezone_set("Europe/Budapest");
    $csatolmany = $_FILES['csatolmany'];
    if ($csatolmany['name'] != ""){
        $fajlnev = $csatolmany['name'];
        $kiterj = substr($fajlnev, strrpos($fajlnev, "."));
        $ujnev = date("YmdHis") . $kiterj;
        move_uploaded_file($csatolmany['tmp_name'], "./FILES/" . $ujnev) ;
    }
    else{
        $fajlnev = $ujnev = "";
    }

    $kiiras = date("Y.m.d H:i:s") . ";" . $_POST['vendegnev'] . ";" . $uzenet . ";" . $fajlnev . ";" . $ujnev . "\r\n";
    $fp = fopen("vendegkonyv.txt", "a");
    fwrite( $fp, $kiiras);
    fclose($fp);

/* Mail küldés
    $mailszoveg = "Kedves Admin, \ra jó kurva anyádat. \r\nUI.: Beleszartam a levesedbe";

    mail("admin@citromail.hu", "Új bejegyzés", $mailszoveg, "From:admin@citromail.hu");
*/
?>

<script>
        alert('Köszönjük üzenetedet.')
        parent.location.href = parent.location.href
</script>