<?php

    if(!$belepve) die("
    <h2>Az oldal megtekintéséhez be kell jelentkezned!</h2>
    ");

?>

<?php

if(!isset($_SESSION['Taxi'])) print
 "

<h1>Szavazás</h1>

<form style='margin:24px 48px; line-height:28px;'
            action='szavazas_ir.php' method='post' target='kisablak'>
        
    <input type='radio' name='melyik' value='1'> Spanyolország <br>
    <input type='radio' name='melyik' value='2'> Olaszország <br>
    <input type='radio' name='melyik' value='3'> Görögország <br>
    <input type='radio' name='melyik' value='4'> Törökország <br>

    <input type='submit' value='Szavazok'>

</form>

" ;

    else
    {
        $fp = fopen("szavazasok.txt", "r") ;
        $allas = fread($fp , filesize("szavazasok.txt")) ;
        fclose($fp);
        $db = explode(";" , $allas) ;
        $ossz = array_sum($db) ;
        $sza[0] = round($db[0]/$ossz*100 , 1) ;
        $sza[1] = round($db[1]/$ossz*100 , 1) ;
        $sza[2] = round($db[2]/$ossz*100 , 1) ;
        $sza[3] = round($db[3]/$ossz*100 , 1) ;

        print   ("Szavazás állása:<br>
                    <style>
                        table#szavazas tr td span{
                            display             : inline-block      ;
                            height              : 12px              ;
                            background-color    : purple            ;
                        }
                    </style>
                    <table id='szavazas'>
                        <tr><td>Spanyolország   <td> $db[0] <td> $sza[0]% <td> <span style='width:".($sza[0]*10)."px;'></span> </tr>
                        <tr><td>Olaszország     <td> $db[1] <td> $sza[1]% <td> <span style='width:".($sza[1]*10)."px;'></span> </tr>
                        <tr><td>Görögország     <td> $db[2] <td> $sza[2]% <td> <span style='width:".($sza[2]*10)."px;'></span> </tr>
                        <tr><td>Törökország     <td> $db[3] <td> $sza[3]% <td> <span style='width:".($sza[3]*10)."px;'></span> </tr>
                    </table>
                ");
    } 
?>