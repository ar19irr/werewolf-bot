<?php
/**
 * 🎯 نقطه ورود اصلی - Webhook Handler
 */

// ⏱️ پاسخ سریع به تلگرام
http_response_code(200);
echo '{"ok":true}';

// گرفتن داده خام از تلگرام
$json = file_get_contents('php://input');

if (empty($json)) {
    exit;
}

// 📝 لاگ برای دیباگ
file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | " . $json . "\n", FILE_APPEND);

// 🔄 تبدیل JSON به آرایه
$data = json_decode($json, true);

if (!$data || !is_array($data)) {
    error_log("Invalid JSON: " . $json);
    exit;
}

// 📦 لود کردن فایل‌ها
require_once 'config.php';
require_once 'functions.php';
require_once 'database.php';
require_once 'game.php';
require_once 'ROLES_PATCH/factory.php';
require_once 'commands.php';

// 🎮 پردازش آپدیت
try {
    processUpdate($data);
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
}

exit;
