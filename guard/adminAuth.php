<?php
function adminAuth(string $location){
    // session_start();
  if(empty($_SESSION) || $_SESSION['role'] !== 1){
    header("Location:".$location);
  }
}
