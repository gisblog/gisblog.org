<?php
###
#
# called to send mail:
# https://docs.aws.amazon.com/ses/latest/DeveloperGuide/send-using-sdk-php.html
#
/*
// ini_set ( "SMTP", "mail.example.com" );
// ini_set ( "smtp_port", "25" );
// ini_set ( "sendmail_from", "from@example.com" );
$to = 'to@example.com';
$subject = 'sub';
$message = 'hi'; 
$from = 'from@example.com';
// send mail:
if ( mail ( $to, $subject, $message ) ) {
	print 'Your mail has been sent successfully.';
} else {
	print 'Unable to send mail.';
}
*/
###

// load class:
require_once '/apache/apache2/_sec/awssdk.php';
require_once '/apache/apache2/htdocs/services/aws/vendor/autoload.php';
use Aws\Exception\AwsException;

$sesclient        = new SesClient([
	'version'     => $arr_awssdk['version'],
	'region'      => $arr_awssdk['region'],
	'credentials' => [
		'key'     => $arr_awssdk['credentials']['key'],
		'secret'  => $arr_awssdk['credentials']['secret']
	]
]);

// set var in caller:
# $sender_email = '@';
# $recipient_emails = [ '@', '@' ];
// $configuration_set = 'ConfigSet';
# $subject = 'Machine Learning Tags Alert';
# $plaintext_body = 'This email was sent with Amazon SES.';
# $html_body = '<h1>This email was sent with'.
# 	' <a href="https://aws.amazon.com/ses/">Amazon SES</a> </h1>';
$char_set = 'UTF-8'; # local scope

// todo: fct/cls - function fct_ses( $sesclient = '', string $sender_email = '', string $recipient_emails = '', string $subject = '', string $plaintext_body = '', string $html_body = '' ) { # default # n/a global # non-defaults (left-side) + defaults (right-side)

try {
	$result = $sesclient -> sendEmail([
		'Destination' => [
			'ToAddresses' => $recipient_emails,
		],
		'ReplyToAddresses' => [$sender_email],
		'Source' => $sender_email,
		'Message' => [
		  'Body' => [
			  'Html' => [
				  'Charset' => $char_set,
				  'Data' => $html_body,
			  ],
			  'Text' => [
				  'Charset' => $char_set,
				  'Data' => $plaintext_body,
			  ],
		  ],
		  'Subject' => [
			  'Charset' => $char_set,
			  'Data' => $subject,
		  ],
		],
		// If you aren't using a configuration set, comment or delete the following line
		// 'ConfigurationSetName' => $configuration_set,
	]);
	$messageId = $result['MessageId'];
	# # # print("Email sent! Message ID: $messageId"."\n");
} catch (AwsException $e) {
	// output error message if fails
	# # # print $e->getMessage();
	# # # print("The email was not sent. Error message: ".$e->getAwsErrorMessage()."\n");
	# # # print "\n";
}
