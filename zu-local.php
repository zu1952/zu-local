<?php
/*
Plugin Name: ZU Local
Description: Плагин для отладки на локальном сервере
Version: 1.0
Author: Erkin Zadauly
*/

// Подключаем zu-local-functions.php
require_once plugin_dir_path(__FILE__) . 'includes/zu-local-functions.php';

/* 
Активация плагина
*/

// После активации выводит сообщение
register_activation_hook( __FILE__, 'zu_local_activation' );

// Выводит после рендеринга страницы сообщение
add_action('wp_footer', 'zu_local_add_promt');

// Включает на все страницы функции
add_action('wp_header', 'zu_local_include');

function zu_local_activation() {
    zu_local_add_promt();
}

function zu_local_include() {
    $zu_local_functions_path = plugin_dir_path(__FILE__);
    $zu_local_functions_path .= 'includes/zu-local-functions.php';
    return '<?php recuire_once ' . $zu_local_functions_path . '?>';
}

// Добавим подменю в меню админ-панели "Инструменты" (tools):
add_action('admin_menu', 'register_zu_local_page');

function register_zu_local_page() {
    add_submenu_page( 'tools.php', 
        __('Local Debug'), 
        __('Debug MSG'),
        'manage_options', 
        'zu-local-page', 
        'zu_local_page_callback' 
    ); 
}

function zu_local_page_callback() {
	// контент страницы
	echo '<div class="wrap">';
    echo '<h2>'. get_admin_page_title() .'</h2>';
    echo '<p>Страница управления локальной отладкой.</p>';
	echo '</div>';
}
