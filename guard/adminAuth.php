<?php
function adminAuth(string $location){
  if(empty($_SESSION) || $_SESSION['role'] !== 1){
    header("Location:".$location);
  }
}
