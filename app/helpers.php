<?php

function admin_log($log, $name = '_')
{
    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('Europe/Warsaw'));
    $log_time = $date->format('Y-m-d H:i:s');

    if (is_array($log)) {
        $log = http_build_query($log, '', ', ');
    }

    $log_msg =  $log_time . ' : ' . $log;
    $folder = dirname(__FILE__) . "/../../../logs/";

    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    $log_file_data = $folder . '/log' . $name . date('d-M-Y') . '_' . date('h') . '.log';
    file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
}