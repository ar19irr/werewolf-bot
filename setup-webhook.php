<?php
require_once 'config.php';
require_once 'functions.php';

echo "🐺 " . BOT_NAME . " - تنظیم Webhook\n";
echo "============================\n\n";

$webhook_url = "https://werewolf-bot-production.up.railway.app/index.php";

echo "📡 آدرس Webhook: " . $webhook_url . "\n\n";

echo "🗑️ حذف Webhook قبلی...\n";
deleteWebhook();
echo "✅ حذف شد\n";

echo "\n🔗 ست کردن Webhook جدید...\n";
$result = setWebhook($webhook_url);

if ($result && $result['ok']) {
    echo "✅ Webhook با موفقیت ست شد!\n";
} else {
    echo "❌ خطا!\n";
    print_r($result);
}
