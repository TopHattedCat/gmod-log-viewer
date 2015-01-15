<html>
	<head>
		<?php echo HTML::style("bootstrap/bootstrap.min.css"); ?>
		<?php echo HTML::style("bootstrap/bootstrap-theme.min.css"); ?>
		<?php echo HTML::style("//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"); ?>
		<title>Log In</title>
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
			<h1><span class="fa fa-steam"></span> <a href="<?php echo $loginurl ?>">Log In</a></h1>
		</div>
	</body>
</html>