<?php
/**
 * 🎯 نقطه ورود اصلی - Webhook Handler
 * 
 * این فایل توسط تلگرام صدا زده میشه و آپدیت‌ها رو پردازش میکنه
 */

// ⏱️ پاسخ سریع به تلگرام (مهم! اگه دیر بشه تلگرام retry میکنه)
http_response_code(200);
echo '{"ok":true}';

// گرفتن داده خام از تلگرام
$json = file_get_contents('php://input');

// اگه داده خالی بود، خارج شو
if (empty($json)) {
    exit;
}

// 📝 لاگ کردن برای دیباگ (اختیاری)
file_put_contents(
    'bot_debug.log', 
    date('Y-m-d H:i:s') . " | IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown') . " | " . $json . "\n", 
    FILE_APPEND
);

// 🔄 تبدیل JSON به آرایه
$data = json_decode($json, true);

// اگه JSON نامعتبر بود
if (!$data || !is_array($data)) {
    error_log("Invalid JSON received: " . $json);
    exit;
}

// 📦 لود کردن فایل‌های مورد نیاز
require_once 'config.php';
require_once 'functions.php';
require_once 'database.php';
require_once __DIR__ . '/ROLES_PATCH/factory.php';  // اضافه بشه
require_once 'game.php';
require_once 'commands.php';

// 🎮 پردازش آپدیت
try {
    processUpdate($data);
} catch (Exception $e) {
    error_log("Error processing update: " . $e->getMessage());
    
    // اگه ارور مهمی بود به ادمین بگو
    if (defined('ADMIN_ID') && ADMIN_ID) {
        sendMessage(ADMIN_ID, "❌ خطا در پردازش:\n" . $e->getMessage());
    }
}

// ✅ تمام
exit;