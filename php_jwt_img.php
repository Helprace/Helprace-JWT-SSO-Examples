<?php
ini_set('display_startup_errors', '1');
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Be sure to upload Firebase JWT library from https://github.com/firebase/php-jwt to "jwt" subdirectory
require __DIR__ . "/jwt/JWT.php";
require __DIR__ . "/jwt/BeforeValidException.php";
require __DIR__ . "/jwt/ExpiredException.php";
require __DIR__ . "/jwt/SignatureInvalidException.php";
use Firebase\JWT\JWT;

$key       = ""; 	// SSO Key from Settings > Authentication
$subdomain = ""; 	// Your Helprace account subdomain, e.g. "companyname"
$now       = time();

$token = array(
  "jti"                 =>  uniqid('', true),
  "iat"                 =>  $now,
  "email"               =>  "user@example.com",
  "name"                =>  "Odiban Canopi",        	// Full name
  "organization"        =>  "Mycompany",       		// Organization name
  "organization_url"    =>  "http://example.com",	// Link to the organization website (starting with http or https)
  "job_title"           =>  "My Job Title",		// Job title
  "avatar"              =>  "",				// URL to user's avatar (starting with http or https)
  "role"                =>  "user",                  	// Role could be: user, agent, admin, owner
  "external_id"         =>  "1"                   	// External ID can be used to uniquely identify user. If not specified, email is used as a unique user ID.
);

$jwt = JWT::encode($token, $key);
$location = "https://auth.helprace.com/jwt/" . $subdomain ."?jwt=" . $jwt;

// Log the user in by displaying an invisible image
echo '<img src="' . $location . '" width="1" height="1" />';
