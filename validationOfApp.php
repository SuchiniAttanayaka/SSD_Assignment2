<?php

// Set page headers function
function setHeader($title)
{
  // Start the session 
  //This is for the purpose of storing access tokens
  if (!headers_sent()) {
    session_start();
  }

  $header_data = "<!doctype html>
  <html>
  <head>
    <title>" . $title . "</title>
    <link href='styles/style.css' rel='stylesheet' type='text/css' />
  </head>
  <body>\n";
  $header_data .= "<a href='fileUpload.php'>Back to Home</a>&nbsp;&nbsp;&nbsp;";
  if(isset($_SESSION['upload_token'])){
    $header_data .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href='fileUpload.php?logout=1'>Logout</a>";  
  }
  $header_data .= "<header><h1>" . $title . "</h1></header>";
  return $header_data;
}

// Function to print error on missing credentials
function warningOfMissingCredentials()
{
  $response_dataset = "
    <h3 class='warn'>
      Warning: You need to set the location of your OAuth2 Client Credentials from the
      <a href='http://developers.google.com/console'>Google API console</a>.
    </h3>
    <p>
      Once downloaded, move them into the root directory of this repository and
      rename them 'oauth-credentials-file.json'.
    </p>";

  return $response_dataset;
}

// get the credentials from the oauth-credentials-file.json 
function getOAuthCredentialsJsonFile()
{
  $oauth_credentials = 'oauth-credentials-file.json';
  if (file_exists($oauth_credentials)) {
    return $oauth_credentials;
  }
  return false;
}
