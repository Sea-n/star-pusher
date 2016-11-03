<?php
require('../config.php');
require('../function.php');

if (!preg_match('/^\d{7,9}$/', $_GET['user_id']))
	exit('User ID Error');

if (!preg_match('/^[a-zA-Z0-9_]{27}$/', $_GET['query_id']))
	exit('Query ID Error');

$score = min(100, $_GET['score']);

sendMsg([
	'bot' => 'Sean',
	'chat_id' => -1001094605665,
	'parse_mode' => 'HTML',
	'text' => "#User{$_GET['user_id']}\n" .
		"Chat: <b>{$_GET['query_id']}</b>\n" .
		"Score: $score\n" .
		"IP Address: {$_SERVER['HTTP_CF_CONNECTING_IP']}\n\n" .
		"Raw Request:\n<pre>" . enHTML(http_build_query($_GET)) . "</pre>\n\n" .
		"Reference:\n<pre>" . enHTML($_SERVER['HTTP_REFERER'] ?? '!!NULL!!') . "</pre>"
]);

if (in_array($_GET['user_id'], [
]))
	exit('Banned User ID');

$result = getTelegram('setGameScore', [
	'bot' => 'Sean',
	'user_id' => $_GET['user_id'],
	'score' => $score,
	'inline_message_id' => $_GET['query_id'],
	'edit_message' => true
]);
