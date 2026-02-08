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

// 📦 لود کردن فایل‌ها - با چک تک تک
try {
    file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | Loading config...\n", FILE_APPEND);
    if (!file_exists('config.php')) {
        throw new Exception('config.php not found');
    }
    require_once 'config.php';
    
    file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | Loading functions...\n", FILE_APPEND);
    if (!file_exists('functions.php')) {
        throw new Exception('functions.php not found');
    }
    require_once 'functions.php';
    
    file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | Loading database...\n", FILE_APPEND);
    if (!file_exists('database.php')) {
        throw new Exception('database.php not found');
    }
    require_once 'database.php';
    
    file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | Loading game...\n", FILE_APPEND);
    if (!file_exists('game.php')) {
        throw new Exception('game.php not found');
    }
    require_once 'game.php';
    
    file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | Loading commands...\n", FILE_APPEND);
    if (!file_exists('commands.php')) {
        throw new Exception('commands.php not found');
    }
    require_once 'commands.php';
    
    file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | All files loaded!\n", FILE_APPEND);
} catch (Exception $e) {
    file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | ERROR: " . $e->getMessage() . "\n", FILE_APPEND);
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
    file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | PROCESS ERROR: " . $e->getMessage() . "\n", FILE_APPEND);
}

exit;
