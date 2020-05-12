<?php
###
#
# called to send text:
# https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/sns-examples-sending-sms.html
#
###

// load class:
require_once '/apache/apache2/_sec/awssdk.php';
require_once '/apache/apache2/htdocs/services/aws/vendor/autoload.php';
use Aws\Exception\AwsException;

$snsclient        = new SnsClient([
	'version'     => $arr_awssdk['version'],
	'region'      => $arr_awssdk['region'],
	'credentials' => [
		'key'     => $arr_awssdk['credentials']['key'],
		'secret'  => $arr_awssdk['credentials']['secret']
	]
]);

// set var in caller:
# $message = 'This message is sent from a Amazon SNS.';
$phone = '+10012409885883'; # local scope # you can send a message directly to a phone number, or you can send a message to multiple phone numbers at once by subscribing those phone numbers to a topic and sending your message to the topic

// todo: fct/cls - function fct_sns( ... ) { # default # n/a global # non-defaults (left-side) + defaults (right-side)

try {
    $result = $snsclient->publish([
        'Message' => $message,
        'PhoneNumber' => $phone,
    ]);
    # # # var_dump($result);
} catch (AwsException $e) {
    // output error message if fails
    # # # error_log($e->getMessage());
}
