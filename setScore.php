<?php
require('../config.php');
require('../function.php');

if (!preg_match('/^\d{7,9}$/', $_POST['user_id']))
	exit('User ID Error');

if (!preg_match('/^[a-zA-Z0-9_-]{27}$/', $_POST['query_id']))
	exit('Query ID Error');

$score = min(100, $_POST['score']);

sendMsg([
	'bot' => 'Sean',
	'chat_id' => -1001094605665,
	'parse_mode' => 'HTML',
	'text' => "#User{$_POST['user_id']}\n" .
		"Chat: <b>{$_POST['query_id']}</b>\n" .
		"Score: $score\n" .
		"IP Address: {$_SERVER['REMOTE_ADDR']}\n\n" .
		"Raw Request:\n<pre>" . enHTML(http_build_query($_POST)) . "</pre>\n\n" .
		"Reference:\n<pre>" . enHTML($_SERVER['HTTP_REFERER'] ?? '!!NULL!!') . "</pre>\n\n" .
		"User-Agent:\n<pre>" . enHTML($_SERVER['HTTP_USER_AGENT'] ?? '!!NULL!!') . "</pre>"
]);

if (in_array($_POST['user_id'], [
]))
	exit('Banned User ID');

if ($score == 0)
exit;

$result = getTelegram('setGameScore', [
	'bot' => 'Sean',
	'user_id' => $_POST['user_id'],
	'score' => $score,
	'inline_message_id' => $_POST['query_id'],
	'edit_message' => true
]);
