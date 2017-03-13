<?php

if($_SESSION['login'] == null){
   echo "<script>location.href='./';</script>";
}