<?php

session_start();
$_SESSION['user_id'] = '';
$_SESSION['user'] = '';
header('location: index.php');
