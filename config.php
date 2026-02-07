<?php
/**
 * ⚙️ تنظیمات ربات Ni_cop_bot
 */

// 🔑 توکن بات
define('BOT_TOKEN', getenv('BOT_TOKEN') ?: '8520546535:AAGUOnE7GYqTKb3jvt49DO_RatT8bgcWSNA');

// 👤 ایدی عددی ادمین
define('ADMIN_ID', getenv('ADMIN_ID') ?: 1095925103);

// 🤖 نام بات
define('BOT_USERNAME', 'Ni_cop_bot');
define('BOT_NAME', 'Ni Cop');

// 📁 مسیرها
define('BASE_PATH', __DIR__ . '/');
define('DATA_PATH', __DIR__ . '/data/');
define('ROLES_PATH', __DIR__ . '/ROLES_PATCH/');

// ⚙️ تنظیمات بازی
define('MIN_PLAYERS', 4);
define('MAX_PLAYERS', 60);
define('GAME_TIMEOUT', 300);

// 🌙 زمان‌بندی شب و روز (ثانیه)
define('NIGHT_DURATION', 60);
define('DAY_DURATION', 60);
define('VOTE_DURATION', 60);

// 🐛 حالت دیباگ
define('DEBUG', false);

if (DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// 🎭 لیست تمام نقش‌ها
define('ALL_ROLES', [
    // ========== تیم روستا (Villager Team) ==========
    'villager',
    'seer',
    'apprentice_seer',
    'guardian_angel',
    'knight',
    'hunter',
    'harlot',
    'builder',
    'blacksmith',
    'gunner',
    'mayor',
    'prince',
    'detective',
    'cupid',
    'beholder',
    'phoenix',
    'huntsman',
    'trouble',
    'chemist',
    'fool',
    'clumsy',
    'cursed',
    'traitor',
    'wild_child',
    'wise_elder',
    'sandman',
    'sweetheart',
    'ruler',
    'spy',
    'marouf',
    'cult_hunter',
    'hamal',
    'jumong',
    'princess',
    'wolf_man',
    
    // ========== تیم گرگ (Werewolf Team) ==========
    'werewolf',
    'alpha_wolf',
    'wolf_cub',
    'lycan',
    'forest_queen',
    'white_wolf',
    'beta_wolf',
    'ice_wolf',
    'enchanter',
    'honey',
    'sorcerer',
    
    // ========== تیم ومپایر (Vampire Team) ==========
    'vampire',
    'bloodthirsty',
    'kent_vampire',
    'chiang',
    
    // ========== تیم قاتل (Killer Team) ==========
    'serial_killer',
    'archer',
    'davina',
    
    // ========== تیم شوالیه تاریکی (Black Knight Team) ==========
    'black_knight',
    'bride_dead',
    
    // ========== تیم جوکر (Joker Team) ==========
    'joker',
    'harly',
    
    // ========== تیم آتش و یخ (Fire & Ice Team) ==========
    'fire_king',
    'ice_queen',
    'lilith',
    
    // ========== تیم فرقه (Cult Team) ==========
    'cultist',
    'royce',
    'frankenstein',
    'monk_black',

    // ========== نقش‌های مستقل (Independent) ==========
    'dian',
    'dinamit',
    'bomber',
    'tso',
    'tanner',
    'lucifer',
    'magento',   
    // ========== نقش‌های تکمیلی ==========
    'doppelganger',
]);

// ⚖️ وزن نقش‌ها برای بالانس
define('ROLE_WEIGHTS', [
    'villager' => 1,
    'seer' => 6,
    'apprentice_seer' => 3,
    'guardian_angel' => 5,
    'knight' => 4,
    'hunter' => 4,
    'harlot' => 3,
    'builder' => 2,
    'blacksmith' => 4,
    'gunner' => 5,
    'mayor' => 2,
    'prince' => 2,
    'detective' => 4,
    'cupid' => 1,
    'beholder' => 2,
    'phoenix' => 3,
    'huntsman' => 4,
    'trouble' => 2,
    'chemist' => 3,
    'fool' => 1,
    'clumsy' => 1,
    'cursed' => -3,
    'traitor' => -4,
    'wild_child' => 2,
    'wise_elder' => 3,
    'sandman' => 2,
    'sweetheart' => 2,
    'ruler' => 3,
    'spy' => 3,
    'marouf' => 3,
    'cult_hunter' => 6,
    'hamal' => 3,
    'jumong' => 2,
    'princess' => 2,
    'wolf_man' => -4,
    'werewolf' => -5,
    'alpha_wolf' => -7,
    'wolf_cub' => -5,
    'lycan' => -5,
    'forest_queen' => -6,
    'white_wolf' => -5,
    'beta_wolf' => -5,
    'ice_wolf' => -5,
    'enchanter' => -5,
    'honey' => -4,
    'sorcerer' => -4,
    'vampire' => -6,
    'bloodthirsty' => -7,
    'kent_vampire' => -6,
    'chiang' => -5,
    'serial_killer' => -7,
    'archer' => -6,
    'davina' => -5,
    'black_knight' => -7,
    'bride_dead' => -6,
    'joker' => -6,
    'harly' => -5,
    'fire_king' => -6,
    'ice_queen' => -6,
    'lilith' => -6,
    'cultist' => -4,
    'royce' => -5,
    'frankenstein' => -5,
    'monk_black' => -4,
    'dian' => -7,
    'dinamit' => -6,
    'bomber' => -6,
    'tso' => -2,
    'tanner' => -3,
    'lucifer' => -6,
    'magento' => -6,
    'doppelganger' => 0,
]);

