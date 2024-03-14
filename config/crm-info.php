<?php


return [
    /**
     * Настройки для работы с клиентом
     */
    'client' => [
        'base_uri' => 'http://ir-crm-nginx',
        'timeout'  => 5.0,
    ],

    /**
     * Диск для хранения информации
     */
    'storageDisk' => 'local',

    /**
     * Время до следующего запроса новой информации
     */
    'timeUntilUpdate' => 'P1D',

    /**
     * Путь до файла с информацией
     *
     * Сохраняется в папке storage/app
     */
    'fileName' => 'crm-info.json'
];
