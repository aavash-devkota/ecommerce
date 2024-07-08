<?php
include 'db.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Simple ecommerce website</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<header>
			<nav class="header-nav">
				<a href="/" class="header-nav-link">Products</a>
				<a href="/cart.php" class="header-nav-link">Cart</a>
				<?php if ($_SESSION['user'] == '') {
				    // Here the user is NOT authenticated.
				    echo '<a href="/login.php" class="header-nav-link">Login</a>';
				    echo '<a href="/register.php" class="header-nav-link">Register</a>';
				} else {
				    // Here the user is authenticated.
				    echo '<p>Hello '.$_SESSION['user'].'</p>';
				    echo '<a href="/logout.php" class="header-nav-link">Logout</a>';
				}?>
			</nav>
		</header>
