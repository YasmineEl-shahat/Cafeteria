<?php
function auth(string $location){
    if(empty($_SESSION)){
        header("Location:".$location);
    }
}
