<?php

require_once("common.php");

$openid_url = $skyrates_prefix . $_GET['openid_identifier_suffix'];
$auth_request = $consumer->begin($openid_url);
$sreg_request = Auth_OpenID_SRegRequest::build(array('username', 'faction'), array('charname'));
$auth_request->addExtension($sreg_request);

// Redirect the user to the OpenID server for authentication.
// Store the token for this authentication so we can verify the
// response.

// For OpenID 1, send a redirect.  For OpenID 2, use a Javascript
// form to send a POST request to the server.
if ($auth_request->shouldSendRedirect()) {
  $redirect_url = $auth_request->redirectURL(getTrustRoot(),getReturnTo());

  // If the redirect URL can't be built, display an error
  // message.
  if (Auth_OpenID::isFailure($redirect_url)) {
	displayError("Could not redirect to server: " . $redirect_url->message);
  } else {
	// Send redirect.
	header("Location: ".$redirect_url);
  }
 } else {
  // Generate form markup and render it.
  $form_id = 'openid_message';
  $form_html = $auth_request->htmlMarkup(getTrustRoot(), getReturnTo(), false, array('id' => $form_id));

  // Display an error if the form markup couldn't be generated;
  // otherwise, render the HTML.
  if (Auth_OpenID::isFailure($form_html)) {
	displayError("Could not redirect to server: " . $form_html->message);
  } else {
	print $form_html;
  }
 }

?>