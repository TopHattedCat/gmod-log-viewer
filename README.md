# Garry's Mod Log Viewer
Server log viewer for Garry's Mod

# Installation

## Prerequisites
* [tMySQL4](http://facepunch.com/showthread.php?t=1442438)
* [steam-login](https://github.com/Ehesp/Steam-Login)

## Instructions
1. Set up [Laravel](http://laravel.com/docs/4.2/installation) on your web server
2. Create a new project and replace the contents of the app folder with the 'Web' folder from this repo
3. Install ehesp/steam-login with Composer
4. Head to app/config/log_viewer.php and configure it with your admin Steam IDs and server list
5. Copy the contents of the contents of the 'Addon' folder to your Garry's Mod server
6. Open logs_config.lua and enter your MySQL and server name
