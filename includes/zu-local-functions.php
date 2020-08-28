<?php
/*
 * Посылка сообщения на консоль *
 ********************************
 * Если сайт работает локально отправляется на консоль  
 * сообщение $txt с параметрами $param.
 * 
 * Запуск функции без аргументов:
 *    выводится текст о том, что сервер запущен локально;
 *    окно сообщения автоматически закрывается через 5 сек.
 * **************************************************************/
function zu_local_add_promt($param = '/time:5', $txt = 'Server started locally') {
    if ($_SERVER['SERVER_ADDR'] == $_SERVER['REMOTE_ADDR']) {
        $cmd = 'msg console';
        execInBackground($cmd, $param, __($txt));
    }
};

// Исполнение команд локально.
// Проверено пока только на Windows.
function execInBackground($cmd, $param, $txt = '') {
    if (substr(php_uname(), 0, 7) == "Windows"){
        pclose(popen($cmd . ' ' . $param . ' ' . $txt, "r")); 
    }
    else {
        exec($cmd . ' ' . $param . ' ' . $txt . " > /dev/null &");  
    }
};

// Подключение функций.
function zu_local_include() {
    $zu_local_functions_path = plugin_dir_path(__FILE__);
    $zu_local_functions_path .= 'includes/zu-local-functions.php';
    return '<?php recuire_once ' . $zu_local_functions_path . '?>';
};

// Включение подпункта "Debug MSG" к меню "Инструменты" (tools) и
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
    echo '<p>вставляем в этом месте функцию "zu_local_add_promt()" с аргументами:</p>';
    echo '<p>"/w", перменная</p>';
	echo '</div>';
};
