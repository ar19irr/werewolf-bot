<?php
// امنیت
$allowed = ['195.201.83.5', '195.201.83.6', '127.0.0.1', '::1'];
if (!in_array($_SERVER['REMOTE_ADDR'], $allowed)) {
    http_response_code(403);
    exit('Forbidden');
}

set_time_limit(30);
ini_set('memory_limit', '256M');

require_once 'config.php';
require_once 'game.php';

$now = time();
$games = getAllActiveGames();

foreach ($games as $game) {
    if ($game['status'] == 'waiting') {
        checkWaitingGame($game, $now);
    } elseif ($game['status'] == 'started') {
        checkStartedGame($game, $now);
    }
}

// پاکسازی حافظه
gc_collect_cycles();

echo "OK";
