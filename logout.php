<?php
    session_start();

    include("adbkapcsolat.php");
    
    //session_destroy();

    unset($_SESSION['uid']);
    unset($_SESSION['unev']);
    unset($_SESSION['umail']);
    unset($_SESSION['upw']);
    unset($_SESSION['ujog']);
    unset($_SESSION['lid']);

    print "
        <script>
            parent.location.href='./'
        </script>
    ";

    mysqli_close($adb);

?>