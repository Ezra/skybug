<?php

require_once("common.php");

function escape($thing) {
    return htmlentities($thing);
}

$return_to = getReturnTo();
$response = $consumer->complete($return_to);

// Check the response status.
if ($response->status == Auth_OpenID_CANCEL) {
  // This means the authentication was cancelled.
  $msg = 'Verification cancelled.';
 } else if ($response->status == Auth_OpenID_FAILURE) {
  // Authentication failed; display the error message.
  $msg = "OpenID authentication failed: " . $response->message;
 } else if ($response->status == Auth_OpenID_SUCCESS) {
  // This means the authentication succeeded; extract the
  // identity URL and Simple Registration data (if it was
  // returned).
  $openid = $response->getDisplayIdentifier();
  $esc_identity = escape($openid);

  $msg = sprintf('You have successfully verified ' .
				 '<a href="%s">%s</a> as your identity.',
				 $esc_identity, $esc_identity);

  $_SESSION['openid'] = $openid;

 }

$_SESSION['msg'] = $msg;
header("Location: index.php");