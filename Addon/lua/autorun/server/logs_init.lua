
LogsConfig = {}
include("logs_config.lua")

if (!tmysql) then require("tmysql4") end

local LogsConnection

hook.Add("InitPostEntity", "Logs_ConnectToServer", function()
	LogsConnection, err = tmysql.initialize(LogsConfig.Host, LogsConfig.User, LogsConfig.Password, LogsConfig.DB, LogsConfig.Port)
	if (err) then
		ErrorNoHalt("LOGS CONNECTION ERROR: " .. err)
	end
	LogsConnection:query([[CREATE TABLE IF NOT EXISTS `logs` (
  `server_id` varchar(12) NOT NULL,
  `times` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
]])
end)

function WebLog(str)
	local sid = LogsConnection:Escape(LogsConfig.ServerID or "UNKWN")
	local str = LogsConnection:Escape(str)
	LogsConnection:query("INSERT INTO logs (server_id, text) VALUES ('" .. sid .. "', UNIX_TIMESTAMP(), '" .. str .. "')")
end

// Overwriting the default logging funcs to send them to the DB

local oldserverlog = ServerLog
function ServerLog(str)
	WebLog(str)
	oldserverlog(str)
end

hook.Add("PostGamemodeLoaded", "HRP_AddLogFuncs", function()
	if (GAMEMODE_NAME == "catalystrp") then
		DB.Log = WebLog
	end
end)