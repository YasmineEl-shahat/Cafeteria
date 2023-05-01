<?php
function auth(string $location){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(empty($_SESSION)){
        header("Location:".$location);
    }
}
