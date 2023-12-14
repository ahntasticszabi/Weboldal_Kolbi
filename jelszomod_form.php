<?php

    if(!$belepve) die("
    
    <h2>Az oldal megtekintéséhez be kell jelentkezned!</h2>
    
    ");

    $user = mysqli_fetch_array(mysqli_query($adb,"
                            SELECT * FROM user WHERE uid='$_SESSION[uid]'
                        "));

?>

<h1>Profil - Jelszó módosítása</h1>
<div class='doboz'>
    <h2><?=$_SESSION['unev'];?></h2>

    <form action='jelszomod_ir.php' method='post' target='kisablak'>
        <input type='password'  name='upw'      placeholder='Jelenlegi jelszavad'>      <br>
        <input type='password'  name='pw1'      placeholder='Új jelszavad'>             <br>
        <input type='password'  name='pw2'      placeholder='Jelszó megerősítése'>      <br>
        <input type='hidden'    name='ustrid'   value='<?=$user['ustrid'];?>'>          <br>
        <hr width=200 style='margin:16px 0px;'>
        <input type='submit' value='Jelszómódosítás'>
    </form>
</div>
     
