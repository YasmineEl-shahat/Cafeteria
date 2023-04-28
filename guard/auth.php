<?php
function auth(string $location){
    // session_start();
    if(empty($_SESSION)){
        header("Location:".$location);
    }
}
