<?php
// ============================================
// ⬇️ امنیت: فقط Cron-job.org مجازه
// ============================================

$allowed_ips = [
    '195.201.83.5',
    '195.201.83.6', 
    '127.0.0.1',
    '::1'
];

$client_ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
if (!in_array($client_ip, $allowed_ips)) {
    http_response_code(403);
    exit('Forbidden: ' . $client_ip);
}

// ============================================
// ⬇️ محدود کردن مصرف
// ============================================

set_time_limit(30);
ini_set('memory_limit', '256M');

// ============================================
// ⬇️ اجرای کرون
// ============================================

require_once 'config.php';
require_once 'game.php';

$now = time();
$games = getAllActiveGames();
$processed = 0;

foreach ($games as $game) {
    if ($game['status'] == 'waiting') {
        checkWaitingGame($game, $now);
        $processed++;
    } elseif ($game['status'] == 'started') {
        checkStartedGame($game, $now);
        $processed++;
    }
}

echo "OK - Processed: " . $processed . " games - IP: " . $client_ip;
