<?php
// Отправляем на консоль сообщение, что сайт работает локально
function zu_local_add_promt($param = '/time:5', $txt = 'Server started locally') {
    if ($_SERVER['SERVER_ADDR'] == $_SERVER['REMOTE_ADDR']) {
        $cmd = 'msg console';
        execInBackground($cmd, $param, __($txt));
    }
}

// Исполнение команд локально
function execInBackground($cmd, $param, $txt = '') {
    if (substr(php_uname(), 0, 7) == "Windows"){
        pclose(popen($cmd . ' ' . $param . ' ' . $txt, "r")); 
    }
    else {
        exec($cmd . ' ' . $param . ' ' . $txt . " > /dev/null &");  
    }
}

