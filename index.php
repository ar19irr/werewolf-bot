<?php
/**
 * 🎯 نقطه ورود اصلی - Webhook Handler
 */

// ⏱️ پاسخ سریع به تلگرام
http_response_code(200);
echo '{"ok":true}';

// گرفتن داده خام از تلگرام
$json = file_get_contents('php://input');

// 📝 لاگ برای دیباگ
file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | RAW: " . $json . "\n", FILE_APPEND);

if (empty($json)) {
    file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | EMPTY JSON\n", FILE_APPEND);
    exit;
}

// 🔄 تبدیل JSON به آرایه
$data = json_decode($json, true);

if (!$data || !is_array($data)) {
    file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | INVALID JSON: " . $json . "\n", FILE_APPEND);
    exit;
}

file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | PARSED: " . print_r($data, true) . "\n", FILE_APPEND);

// 📦 لود کردن فایل‌ها
require_once 'config.php';
require_once 'functions.php';
require_once 'database.php';
require_once 'game.php';
require_once 'ROLES_PATCH/factory.php';
require_once 'commands.php';

// 🎮 پردازش آپدیت
try {
    file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | BEFORE processUpdate\n", FILE_APPEND);
    
    if (!function_exists('processUpdate')) {
        file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | ERROR: processUpdate not found!\n", FILE_APPEND);
        exit;
    }
    
    processUpdate($data);
    file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | SUCCESS\n", FILE_APPEND);
} catch (Exception $e) {
    file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | ERROR: " . $e->getMessage() . "\n", FILE_APPEND);
    file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | STACK: " . $e->getTraceAsString() . "\n", FILE_APPEND);
}

exit;
