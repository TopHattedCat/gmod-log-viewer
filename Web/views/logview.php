<html>
	<head>
		<?php echo HTML::style("bootstrap/bootstrap.min.css"); ?>
		<?php echo HTML::style("bootstrap/bootstrap-theme.min.css"); ?>
		<?php echo HTML::script("jquery.js"); ?>
		<?php echo HTML::script("bootstrap/bootstrap.min.js"); ?>
		<?php echo HTML::style("//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"); ?>
		<?php echo HTML::style("bootstrap/cal.css"); ?>
		<?php echo HTML::script("bootstrap/cal.js"); ?>
		<title>Log View</title>
		<script>
			var serverName = "<?php echo $server; ?>";
			function ShowTimeList() {
				$("#chose_time").modal("toggle");
			}
			
			
			$(document).ready(function() {
				$("#calendar").zabuto_calendar({language: "en", data: [], action: function() {
					var theDate = $("#" + this.id).data("date");
					theDate = theDate.split("-");
					// 0 year | 1 month | 2 day
					var newDate = theDate[1] + "," + theDate[2] + "," + theDate[0];
					var totalDate = (new Date(newDate)).getTime() / 1000;
					location.href = "http://" + location.hostname + "/log/" + serverName + "/" + totalDate;
				}});
			});
			
		</script>
		<style>
			body
			{
				padding-left: 22px;
				padding-right: 22px;
			}
		</style>
	</head>
	<body>

		<div class="modal fade" id="chose_time">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-times">
						</span></span></button>
						<h4 class="modal-title">Select Date</h4>
					</div>
					<div class="modal-body">
						<div id="calendar"></div>
					</div>
				</div>
			</div>
		</div>
		<br>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<span class="navbar-brand">Server Logs</span>
				</div>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#" onclick="ShowTimeList()"><span class="fa fa-calendar"></span> Change Log Date</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="fa fa-database"></span> Select Server</a>
						<ul class="dropdown-menu" role="menu">
							<?php
								$requestRoot = Request::root();
								foreach ($serverlist as $serv) {
									echo("<li><a href='" . $requestRoot . "/log/" . $serv . "/'>" . $serv . "</a></li>");
								}
							?>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
		<div>
			<h1>Viewing log for <b id="time"><?php echo $time ?></b> on server <b data-toggle="server_list" id="server"><?php echo $server ?></b></h1>
			<?php
				foreach ($log_rows as $row) {
					echo("<b>" . date("h:i:s A", intval($row->times)) . "</b> " . $row->text . "<br>");
				}
			?>
		</div>
	</body>
</html>