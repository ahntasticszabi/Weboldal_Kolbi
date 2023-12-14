<?php

    if(!$belepve) die("
    
    <h2>Az oldal megtekintéséhez be kell jelentkezned!</h2>
    
    ");

    $user = mysqli_fetch_array(mysqli_query($adb,"
                            SELECT * FROM user WHERE uid='$_SESSION[uid]'
                        "));

?>

<h1>Profil - Adatmódosítás</h1>
<div class='doboz'>
    <h2><?=$_SESSION['unev'];?></h2>

    <form action='adatmod_ir.php' method='post' target='kisablak'>
        <input type='text'      name='unev'     placeholder='Felhasználónév'    value='<?=$user['unev'];?>'>    <br>
        <input type='text'      name='umail'    placeholder='E-mail cím'        value='<?=$user['umail'];?>'>   <br>
        <input type='password'  name='upw'      placeholder='Jelszó az ellenőrzéshez'>                          <br>
        <input type='hidden'    name='ustrid'   value='<?=$user['ustrid'];?>'>                                  <br>
        <hr width=200 style='margin:16px 0px;'>
        <input type='submit' value='Adatmódosítás'>
    </form>
</div>
     
