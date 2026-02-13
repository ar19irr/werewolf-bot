<?php
// ============================================
// ⬇️ تنظیمات
// ============================================

ini_set('memory_limit', '512M');
set_time_limit(30);

// ⬇️ پاسخ سریع
http_response_code(200);
echo "OK";
flush();

// ============================================
// ⬇️ فقط فایل‌های ضروری
// ============================================

require_once 'config.php';
// game.php فقط وقتی لود می‌شه که نیاز باشه
// commands.php هم همینطور

$json = file_get_contents('php://input');
if (empty($json)) exit;

$data = json_decode($json, true);
if (!$data) exit;

// لود تنبل (Lazy Loading)
if (isset($data['message']) || isset($data['callback_query'])) {
    require_once 'game.php';
    try {
        processUpdate($data);
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}

exit;
