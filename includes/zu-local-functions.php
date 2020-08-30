<?php
/*
 * Посылка сообщения на консоль *
 ********************************
 * Запуск функции:
 *    $param = '/time:n' | '/w', можно комбинировать. 
 *        n - время показа диалогового окна в секундах.
 *        /w - вывод кнопки "ОК" и ожидание реакции пользователя.
 *    $txt = выводимый текст.
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

