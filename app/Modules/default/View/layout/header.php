
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Webshop ID College</title>

	<!-- Bootstrap core CSS -->
	<link href="/Includes/Css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="/Includes/Css/stylesheet.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-inverse">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Project name</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<?php
			if(isset($loggedInUserName)) {
				?>
				<div class="dropdown pull-right">
					<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<?php echo "Welkom, " . $loggedInUserName; ?>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
						<li><a href="/dashboard">Dashboard</a></li>
						<li><a href="/winkelmandje">Winkelmandje</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="/login/log-out">Uitloggen</a></li>
					</ul>
				</div>
			<?php
			} else {
				echo "<a href='/login' class='btn btn-success'>Login</a>";
			}
			?>
		</div><!--/.navbar-collapse -->
	</div>
</nav>