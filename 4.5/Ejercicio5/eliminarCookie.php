<?php
        if(isset($_GET['eliminarCookie'])) {
            foreach ($_COOKIE['usuario'] as $key=>$value) {
                if ($key == "email") {
                    setcookie('usuario['.$key.']', $value, time() - 1800);
                }
            }
        }
        header("Location: ./cookieArray.php");
?>