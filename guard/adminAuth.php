<?php
function adminAuth(string $location){
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  if(empty($_SESSION) || $_SESSION['role'] !== 1){
    header("Location:".$location);
  }
}
