<?php
/**
 * 🎯 نقطه ورود اصلی - Webhook Handler
 */

// ⏱️ پاسخ سریع به تلگرام
http_response_code(200);
echo '{"ok":true}';

// 📝 لاگ شروع
file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | START\n", FILE_APPEND);

// گرفتن داده خام از تلگرام
$json = file_get_contents('php://input');

if (empty($json)) {
    file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | EMPTY JSON\n", FILE_APPEND);
    exit;
}

file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | GOT JSON\n", FILE_APPEND);

// 📦 لود کردن فایل‌ها
try {
    require_once 'config.php';
    require_once 'functions.php';
    require_once 'database.php';
    require_once 'game.php';  // این خودش factory رو لود می‌کنه
    require_once 'commands.php';
    
    file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | All files loaded!\n", FILE_APPEND);
} catch (Exception $e) {
    file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | REQUIRE ERROR: " . $e->getMessage() . "\n", FILE_APPEND);
    exit;
}

// 🔄 تبدیل JSON به آرایه
$data = json_decode($json, true);
file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | JSON decoded\n", FILE_APPEND);

// 🎮 پردازش آپدیت
try {
    processUpdate($data);
    file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | SUCCESS\n", FILE_APPEND);
} catch (Exception $e) {
    file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | ERROR: " . $e->getMessage() . "\n", FILE_APPEND);
}

exit;
