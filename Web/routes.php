<?php

function IsLoggedIn() {
	$steamID = Session::get("steamid", true);
	if (is_bool($steamID)) {
		return false;
	} else {
		return true;
	}
}

function ValidLogin() {
	$sid = Session::get("steamid", "0");
	if ($sid == "0") then
		return "NOLOG";
	}
	if (!(in_array($sid, Config::get("log_viewer.allowed_steam_ids")))) {
		return "UNAUTH";
	}
	return "YES";
}

Route::get('/', function()
{
	if (IsLoggedIn()) {
		$end = "/log/ALL/" . strtotime("midnight");
	} else {
		$end = "/login";
	}
	return "<meta http-equiv='refresh' content='0; " . Request::url() . $end . "'>";
});

Route::get("log/{servername}/{timestamp?}", function($server, $times = NULL) {
	$isLoggedIn = ValidLogin();
	if ($isLoggedIn == "NOLOG") {
		return Redirect::to("login");
	} elseif ($isLoggedIn == "UNAUTH") {
		return Redirect::to("unauth");
	}
	if (is_null($times)) {
		$time = $time = strtotime("midnight", time());
	} else {
		$time = strtotime("midnight", $times);
	}
	
	$endtime = $time + 86400;
	if ($server == "ALL") {
		$results = DB::select("SELECT * FROM logs WHERE times>? AND times<?", array($server, $time, $endtime));
	} else {
		$results = DB::select("SELECT * FROM logs WHERE server_id=? AND times>? AND times<?", array($server, $time, $endtime));
	}
	
	$properView = date("l jS \of F Y", $time);
	return View::make("logview", array("time" => $properView, "log_rows" => $results, "server" => $server, "serverlist" => Config::get("log_viewer.servers")));
});


Route::get("login", function($action="") {
	if (IsLoggedIn()) {
		return Redirect::to("/");
	} else {
		$url = SteamLogin::url(URL::to("authenticate"));
		return View::make("login", array("loginurl" => $url));
	}
});

Route::get("authenticate", function() {
	try {
		$sid = SteamLogin::validate();
		Session::put("steamid", $sid);
		return Redirect::to("/");
	} catch (Exception $e) {
		return "Error while logging in.";
	}
});

Route::get("unauth", function() {
	return View::make("unauth", array("steamid" => Session::get("steamid", "0")));
});