<?php

    if(!$belepve) die("
    
    <h2>Az oldal megtekintéséhez be kell jelentkezned!</h2>
    
    ");

?>

<h1>Vendégkönyv</h1>

<?php
    $szj            = array("", "egy", "kettő", "három", "négy", "öt", "hat", "hét", "nyolc", "kilenc");
    $ca             = rand(1, 9);
    $cb             = rand(2, 9);
    $_SESSION['cc'] = 10+$ca+$cb   ;
?>


<form style='margin:24px 48px; line-height:28px;'
            action='vendegkonyv_ir.php' method='post' target='kisablak' enctype='multipart/form-data'>
    Név: <input name='vendegnev'><br>
    Szöveg:<br>
    <textarea name='uzenet' cols=60 rows=8></textarea></br>
    <input type='file' name='csatolmany'><br>
    Mennyi tizen<?=$szj[$ca];?> + <?=$szj[$cb];?>? <input name='captcha' maxlength=2><br>
    <input type='submit' value='Üzenet elküldése'>
</form>

<?php
    $fp = fopen("vendegkonyv.txt", "r");
    while($sor = fgets($fp)) {
        $sorok[] = $sor;
    }   
    $sorok = array_reverse($sorok) ;
    for($i=0; $i<count($sorok); $i++)
    {
        $adat = explode(";", $sorok[$i]);
        if ($adat[3]!="") {
            $csatolmany= " <p align=right>Csatolt fájl: <a href='./FILES/$adat[4]' target=_blank>$adat[3]</a></p>";
        }
        else {
            $csatolmany = "";
        }
        print ("<div style='margin:18px; background-color:#DDD; padding:8px;'>
                    <span style='float:right'>$adat[0]</span>
                    ".(count($sorok)-$i).". | <b>$adat[1]</b>
                    <hr>
                    <i>$adat[2]</i>
                    $csatolmany
                </div>");
    }
    fclose($fp);
?>
     
