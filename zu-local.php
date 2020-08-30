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

// При активации выводится сообщение о том, что сервер локальный.
function zu_local_activation() {
    zu_local_add_promt();
};

// Подключает функции плагина на всех страницах
add_action('wp_header', 'zu_local_include');

// Добавим подменю в меню админ-панели
add_action('admin_menu', 'register_zu_local_page');
// Включение подпункта "Debug MSG" в "Инструменты" (tools) и
// регистрация функции отображения страницы плагина.
function register_zu_local_page() {
    add_submenu_page( 'tools.php', 
        __('Local Debug'), 
        __('Debug MSG'),
        'manage_options', 
        'zu-local-page', 
        'zu_local_page_callback' 
    ); 
};
// Отображение страницы плагина.
function zu_local_page_callback() {
	// контент страницы
	echo '<div class="wrap">';
    echo '<h2>'. get_admin_page_title() .'</h2>';
    echo '<p>Для получения значения переменной в определенном месте кода:</p>';
    echo '<p>вставляем в этом месте функцию <strong>"zu_local_add_promt()"</strong></p>';
    echo '<p>с аргументами: <storng>(\'/w\', переменная значение которой надо вывести)</storng></p>';
    echo '<p>Т.е., <strong>zu_local_add_promt(\'/w\', переменная значение которой надо вывести);</strong></p>';
    echo '<p>где параметр <strong>\'/w\'</strong> означает, что окно сообщения ждет нажатия кнопки <strong>ОК</strong> и только после этого оно будет закрыто.</p>';
    echo '<p>Можно в первый параметр добавить <strong>\'/time:n /w\'</strong>, где <strong>n</strong> время в секундах, после которого окно закроется автоматически.</p>';
	echo '</div>';
};
