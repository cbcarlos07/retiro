<?php
/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 26/12/2016
 * Time: 20:56
 */
session_start();
$_SESSION['login'] = "";
session_destroy();
header("location: .");