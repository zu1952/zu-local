<?php
/*
 * Plugin Name: ZU Local
 * Description: Плагин для отладки на локальном сервере
 * Version: 1.0
 * Author: Erkin Zadauly
 *******************************************************/

// Подключаем zu-local-functions.php
require_once plugin_dir_path(__FILE__) . 'includes/zu-local-functions.php';

// Активация плагина.
register_activation_hook( __FILE__, 'zu_local_activation' );

// При активации запускается функция вывода сообщения.
function zu_local_activation() {
    zu_local_add_promt();
};

// Подключает функции плагина
add_action('wp_header', 'zu_local_include');

// Добавим подменю в меню админ-панели
add_action('admin_menu', 'register_zu_local_page');
