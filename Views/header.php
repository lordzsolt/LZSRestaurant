<!--
/**
 * Created by IntelliJ IDEA.
 * User: Lord Zsolt
 * Date: 13/06/2015
 * Time: 14:00
 */
 -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<!-- My CSS -->
	<link rel="stylesheet" href="css/main.css">
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<ul class="nav nav-pills navbar-nav navbar-left">
			<li><a href="index">Menu</a></li>

			<?php if (isset($isLoggedIn) && $isLoggedIn): ?>
				<li><a href="#">My Order</a></li>
			<?php endif; ?>

		</ul>
		<ul class="nav nav-pills navbar-nav navbar-right">
			<?php if (isset($isLoggedIn) && $isLoggedIn): ?>
				<li><a href="myinfo">My Info</a></li>
			<?php endif; ?>

			<?php if (isset($isLoggedIn) && $isLoggedIn && isset($isAdmin) && $isAdmin): ?>
				<li><a href="#">Admin</a></li>
			<?php endif; ?>

			<?php if (!isset($isLoggedIn) || !$isLoggedIn): ?>
				<li><a href="#">Register</a></li>
				<li><a href="login">Login</a></li>
			<?php endif; ?>
		</ul>
	</div>
</nav>