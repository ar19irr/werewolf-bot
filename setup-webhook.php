<?php
/**
 * 🔗 تنظیم Webhook
 * 
 * این فایل رو یه بار اجرا کن تا webhook ست بشه
 */

require_once 'config.php';
require_once 'functions.php';

echo "🐺 " . BOT_NAME . " - تنظیم Webhook\n";
echo "============================\n\n";

// آدرس فعلی رو بگیر
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$path = dirname($_SERVER['REQUEST_URI']);
$webhook_url = getenv('WEBHOOK_URL') ?: ($protocol . "://" . $host . $path . "/index.php");

echo "📡 آدرس Webhook: " . $webhook_url . "\n\n";

// حذف webhook قبلی
echo "🗑️ حذف Webhook قبلی...\n";
$result = deleteWebhook();
if ($result && $result['ok']) {
    echo "✅ حذف شد\n";
} else {
    echo "⚠️ خطا یا وجود نداشت\n";
}

// ست کردن webhook جدید
echo "\n🔗 ست کردن Webhook جدید...\n";
$result = setWebhook($webhook_url);

if ($result && $result['ok']) {
    echo "✅ Webhook با موفقیت ست شد!\n\n";

    // گرفتن اطلاعات webhook
    $info_url = "https://api.telegram.org/bot" . BOT_TOKEN . "/getWebhookInfo";
    $info = apiRequest($info_url);

    if ($info && $info['ok']) {
        echo "📊 اطلاعات Webhook:\n";
        echo "  URL: " . ($info['result']['url'] ?? 'نامشخص') . "\n";
        echo "  Pending updates: " . ($info['result']['pending_update_count'] ?? 0) . "\n";
        echo "  Max connections: " . ($info['result']['max_connections'] ?? 'نامشخص') . "\n";
    }

    echo "\n🎉 همه چی آماده‌ست!\n";
    echo "📱 بات رو تست کن: /start\n";

} else {
    echo "❌ خطا در ست کردن Webhook!\n";
    if ($result && isset($result['description'])) {
        echo "   " . $result['description'] . "\n";
    }
    exit(1);
}