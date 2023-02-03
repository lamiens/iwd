<?php

/*Authentification*/
$base_url_api = "https://api.app.shortcut.com";
$token = getenv()["SHORCUT_API_TOKEN"];

/*Folders*/
$root_dir_app = dirname(__FILE__);
$views_dir = $root_dir_app.'/views';
$base_dir_api = $root_dir_app.'/api';
$paths = $base_dir_api.'/paths.php';
$inc_dir = $root_dir_app.'/inc';
$csv_dir = $root_dir_app.'/csv';
$asset_dir = $root_dir_app.'/assets';
