<?php
    session_start();
    date_default_timezone_set("Europe/Budapest");

    if(isset($_SESSION['uid'])) $belepve=1  ;
    else                        $belepve=0  ;

    include("adbkapcsolat.php");
    
    if($belepve) $lid=$_SESSION['lid']; else $lid=-1;
    mysqli_query($adb, "INSERT INTO naplo   (nid, nurl,                     ndatum, nip,                        nlid)
                        VALUES              ('', '$_SERVER[REQUEST_URI]',   NOW(),  '$_SERVER[REMOTE_ADDR]',    '$lid')
                        ");

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>
    <?php

    if( isset($_GET['p'])) $p=$_GET['p'] ; else $p="" ;

    if($p==""               )   print "Főoldal"             ; else
    if($p=="rolunk"         )   print "Mi cégünk"           ; else
    if($p=="termekek"       )   print "Termékeink"          ; else
    if($p=="karrier"        )   print "Álláslehetőségek"    ; else
    if($p=="forum"          )   print "Fórumok"             ; else
    if($p=="kapcs"          )   print "Elérhetőségeink"     ; else
    if($p=="vend"           )   print "Vendégkönyv"         ; else
    if($p=="szav"           )   print "Szavazás"            ; else
    if($p=="login"          )   print "Belépés"             ; else
    if($p=="reg"            )   print "Regisztráció"        ; else
    if($p=="profil"         )   print "Profil"              ; else
                                print "Parallel Universe"   ;
    ?>
    </title>
</head>
<body>
<?php
    if(!$belepve) print "  
        <div id='container'>
        <nav>
            <div id='logo'>
                IZ*Panorama
            </div>
            <ul>
                <li><a href='./'>Kezdőoldal</a></li>
                <li><a href='./?p=rolunk'>Rólunk</a></li>
                <li><a href='./?p=kapcs'>Kapcsolat</a></li>
                <li><a href='./?p=login'>Belépés</a></li>
            </ul>
        </nav>
        </div>
        " ;
    
    else print "
        <div id='container'>
        <nav>
            <div id='logo'>
                IZ*Panorama
            </div>
            <ul>
                <li><a href='./'>Kezdőoldal</a></li>
                <li><a href='./?p=rolunk'>Rólunk</a></li>
                <li><a href='./?p=kapcs'>Kapcsolat</a></li>
                <li><a href='./?p=termekek'>Termékeink</a></li>
                <li><a href='./?p=vend'>Vendégkönyv</a></li>
                <li><a href='./?p=szav'>Szavazás</a></li>
                <li class='dropdown'><a href='./?p=profil'>$_SESSION[unev]<i class='fa fa-caret-down'></i></a>
                    <div class='dd'>
                        <div id='u_a_c'></div>
                        <ul>
                            <li> <a href='./?p=adatmod'> Adatok módosítása</a>
                            <li> <a href='./?p=jelszomod'>Jelszó módosítása</a>
                            <li> <a href='./?p=profilkep'>Profilkép szerkesztése</a>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
        </div>
          
    " ;
?> 
<div id=tartalom>
<?php

    // print_r( $_GET )    ;
    if( isset($_GET['p'])) $p=$_GET['p'] ; else $p="" ;

    if($p==""               )   print "<h1>Kezdőoldal</h1>"                         ; else
    if($p=="rolunk"         )   print "<h1>Rólunk</h1>"                             ; else
    if($p=="termekek"       )   print "<h1>Termékeink</h1>"                         ; else
    if($p=="karrier"        )   print "<h1>Karrier</h1>"                            ; else
    if($p=="forum"          )   print "<h1>Fórum</h1>"                              ; else
    if($p=="kapcs"          )   include("elerhetoseg.php")                          ; else
    if($p=="vend"           )   include("vendegkonyv_form.php")                     ; else
    if($p=="szav"           )   include("szavazas_form.php")                        ; else
    if($p=="login"          )   include("login_form.php")                           ; else
    if($p=="reg"            )   include("reg_form.php")                             ; else
    if($p=="profil"         )   include("profil.php")                               ; else
    if($p=="adatmod"        )   include("adatmod_form.php")                         ; else
    if($p=="jelszomod"      )   include("jelszomod_form.php")                       ; else
    if($p=="profilkep"      )   include("profilkepmod_form.php")                       ; else

    
                                print "<h1>404 - A kért oldal nem található</h1>"   ;   

?>

<?php

        $fajlnev = date("Ymd") . ".txt" ;
            
        if ( !file_exists($fajlnev) ) 
        {
            $fp = fopen ($fajlnev , "w") ; // létrehozás
            fwrite($fp , "0") ;
            fclose($fp) ;
        }

        //$n = 528 ;

        $fp = fopen ($fajlnev , "r") ; // olvasásra megnyit
        $n = fread($fp , filesize($fajlnev)) ;
        fclose($fp) ;

        if(!isset($_SESSION['eg']))
        {
            $n++ ;

            $fp = fopen ($fajlnev , "w") ; // felülírás
            fwrite($fp , $n) ;
            fclose($fp) ;

            $_SESSION['eg'] = "kábel" ;
        }

        print "<hr style='margin-top:120px'><p>Az oldalt eddig $n. látogató látta.</p>" ;

        mysqli_close($adb);
?>
</div> 
<iframe name='kisablak' x_width=0 y_height=0 z_frameborder=0></iframe>
</body>
</html>
