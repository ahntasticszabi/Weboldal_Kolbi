<?php

    if(!$belepve) die("<h2>Az oldal megtekintéséhez be kell jelentkezned!</h2>");
?>
<h1>Profil</h1>
<div class='doboz'>
    <h2><?=$_SESSION['unev'];?></h2>

    <ul>
        <li> <a href='./?p=adatmod'> Adatok módosítása</a>
        <li> <a href='./?p=jelszomod'>Jelszó módosítása</a>
        <li> <a href='./?p=profilkep'>Profilkép szerkesztése</a>
        <hr width=200 style='margin:8px -20px;'>
        <input type='button' class='gomb' value='Kilépés' onclick='location.href="logout.php"'>
    </ul>
</div>