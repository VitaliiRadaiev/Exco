<?php



/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'exso_db' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'exso_db' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'AErRYt5J' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'exso.mysql.tools' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Q}Z)dAp;dmI+LZFB[S;1rhR_kngESu]KS*I8tC&.*GBM2ELV?9zS}CUy_m!I^eS7' );
define( 'SECURE_AUTH_KEY',  '9y8k>m@V8Q%$neQ_?Jr$v<toAZOomi513:wyi8AR`PYO=C-8Zp/JjCZsY@xy*~!O' );
define( 'LOGGED_IN_KEY',    ')AmSKP.H)o#43w2UoOEXM8l=A>3^*t:}j@]}9ZN{~4$;)_-go|N6,weQukt%uvqI' );
define( 'NONCE_KEY',        'Nlu&#PnXVHl-TQ]0Hkc>@X*s&tW!`MDOiktRF!avI,[AM:9Or 9I?d w[)+60IW}' );
define( 'AUTH_SALT',        ';ep>E%yTi*aRYgj#bIpyzF~NI)]W#4w+]SfSgR :jfuStrW7HTq&5Q}3q|I47G|P' );
define( 'SECURE_AUTH_SALT', '*1qwIQ[S|!%F1o0XU/94gH;,PE;W_]x>]n~Ek!FqTY7=Nw`[M=/G<5 LnYW$;&^1' );
define( 'LOGGED_IN_SALT',   'iXq`kx-Zj(Ea6EuY@UTjuoG@+W#O90Sn9fKPj [,Vt~dub`m*a{&}-$(4H3_f&5s' );
define( 'NONCE_SALT',       '+voArmT(;WNxZ65dc3!c^+h{}H-^8-{(AClj!![xnaRW:dK#0m*G}(=<+8nYU1C)' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';
$_SERVER['HTTPS']='on';
/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
