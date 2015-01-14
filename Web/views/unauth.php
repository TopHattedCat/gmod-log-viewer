<html>
	<head>
		<?php echo HTML::style("bootstrap/bootstrap.min.css"); ?>
		<?php echo HTML::style("bootstrap/bootstrap-theme.min.css"); ?>
		<?php echo HTML::style("//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"); ?>
		<title>Unauthorised</title>
		<style>
			body
			{
				padding-left: 22px;
				padding-right: 22px;
			}
		</style>
	</head>
	<body>
		<br>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<span class="navbar-brand">Server Logs</span>
				</div>
			</div>
		</nav>
		<div>
			<h1><span class="fa fa-lock"></span> Unauthorised!</h1>
			<p class="lead">Your Steam ID, <?php echo $steamid ?> is not on the whitelist for this site, thus it is inaccessible. If you feel this is in error, contact the owner of this site.</p>
		</div>
	</body>
</html>