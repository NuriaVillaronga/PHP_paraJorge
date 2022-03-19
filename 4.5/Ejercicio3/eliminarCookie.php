<?php
        if(isset($_GET['eliminarCookie'])) {
            foreach ($_COOKIE as $key=>$value) {
                setcookie($key, $value, time() - 1800);
            }
        }
        header("Location: ./cookies3.php");
?>