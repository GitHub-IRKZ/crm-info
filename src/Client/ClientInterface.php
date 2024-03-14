<?php

namespace Irkz\Crminfo\Client;

use Irkz\Crminfo\Client\Response\InformationResponse;

/**
 * Интерфейс клиента для получения информации из CRM
 */
interface ClientInterface
{
    /**
     * Получает информацию о проекте из CRM
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInfo(): InformationResponse;
}
