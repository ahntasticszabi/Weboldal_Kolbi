<?php

    if(!$belepve) die("
    <h2>Az oldal megtekintéséhez be kell jelentkezned!</h2>
    ");

    $user = mysqli_fetch_array(mysqli_query($adb,"
                            SELECT * FROM user WHERE uid='$_SESSION[uid]'
                        "));

?>

<h1>Profil - Profilképmódosítás</h1>
<div class='doboz'>
    <h2><?=$_SESSION['unev'];?></h2>

    <form action='profilkepmod_ir.php' method='post' enctype='multipart/form-data' target='kisablak'>
        <input type='file'      name='ukep'         >                                                                   <br>
        <input type='password'  name='upw'      placeholder='Jelszó az ellenőrzéshez'>                                  <br>
        <input type='hidden'    name='ustrid'   value='<?=$user['ustrid'];?>'>                                          
        <hr width=200 style='margin:16px 0px;'>
        <input type='submit' value='Képmódosítás'>
        <hr width=200 style='margin:16px 0px;'>
    </form>

    <?php
    print "<h3>Az Aktuális profilképed</h3>
    <div class='kiskep'>";
    $profilkep = mysqli_query($adb, "
                SELECT uprofilkep 
                FROM user 
                WHERE   ustrid      =   '$user[ustrid]'
        ");
        $rows = mysqli_fetch_array($profilkep);
        $kep = $rows['uprofilkep'];


    print "<img src='PROFILKEP/$kep' alt='$kep'>
    </div>";

    ?>
</div>


     
