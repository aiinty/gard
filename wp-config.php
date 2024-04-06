<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'gard' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'root' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', '' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'RhBL/~o{R#6a<O@0DV-[,G[Z&T8M2?lL;%}Vm#p@EoTWt]q25jaieP:Y1v}QD,k1' );
define( 'SECURE_AUTH_KEY',  '8GntrcJcn;{NASrzr${7&%jq}tOR=z2HV/gapVWrq@~4Txr/JLwl?j4uDJGY$bA(' );
define( 'LOGGED_IN_KEY',    'LRD)ycYbW1:l3_Y&P4khPM4U0`RXWH(W-54$~OO9!7d.G2:.V2o&xN>p2v;`O=SZ' );
define( 'NONCE_KEY',        'mP-Q,,s+5zVd6vu,45T~(.UVU,n F<A|i38a+17x<|.KDurxl7=Ki_:5p7s{xoby' );
define( 'AUTH_SALT',        'bh|;d6S,Mp+A%P,{!zA7cCh3@_}._ura:C#`g}.,8C)+stf,) &HytXaDpz -W1|' );
define( 'SECURE_AUTH_SALT', 'Dn#(rHDwyrA1%/bAI_&>9yVwigE=BmFSOrkTbpwmB)*(SftaRRhF^n)e4Hlii/,C' );
define( 'LOGGED_IN_SALT',   'Ah#FTu[J>.W^Y-@xNkD9cIbR]?2B*._2[v:#sxIzkH=|W~+e(J4Myno@rsP3HW65' );
define( 'NONCE_SALT',       '@nq1ejc,vw&8V_-n+lw9DD1S.WaIP&MbPWTWRQ}~vOwburT`As(/P*wgZlTL%KfJ' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
