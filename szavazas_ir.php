<?php
    session_start();
    if(isset($_SESSION['Taxi']))
    {
        die("<script> alert('Már szavaztál gekkóképű')</script>") ;
    }
    else {
        $_SESSION['Taxi'] = "Kuplung" ;
    }
    
    print session_id();

    print_r($_POST);

    print $_POST['melyik'];

    if(!isset($_POST['melyik'])) {
        die("<script> alert('Nem is szavaztál!') </script>") ;
    }

    if( !file_exists("szavazasok.txt") ) {
        $fp = fopen("szavazasok.txt" , "w") ;
        fwrite($fp , "0;0;0;0");
        fclose($fp);
    }

    $fp = fopen("szavazasok.txt", "r") ;
    $allas = fread($fp , filesize("szavazasok.txt")) ;
    fclose($fp);

    $db = explode(";" , $allas) ;
    $db[$_POST['melyik']-1]++ ;
    $allas = implode(";" , $db) ;

    print $allas ;

    $fp = fopen("szavazasok.txt" , "w") ;
    fwrite($fp , $allas);
    fclose($fp);

?>
<script>
    parent.location.href = parent.location.href // frissítés (F5)
</script>