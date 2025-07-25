<?php


return [
    /**
     * Настройки для работы с клиентом
     */
    'client' => [
        'base_uri' => 'https://crm.ir.kz',
        'timeout'  => 2.0,
    ],

    /**
     * Токен для компании для получения информации из CRM
     */
    'token' => env('CRM_INFO_TOKEN'),

    /**
     * Диск для хранения информации
     */
    'storage' => 'local',

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
