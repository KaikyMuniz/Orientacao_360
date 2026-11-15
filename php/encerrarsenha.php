<?php

if(!isset($_SESSION)){
    session_start();
}

session_destroy(); //DESTRUIR AS VARIAVEIS/SESSÕES.

header("Location: login.php");
?>