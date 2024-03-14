<?php declare(strict_types=1);

namespace Irkz\Crminfo\Client;

use GuzzleHttp\Client;
use Irkz\Crminfo\Client\Response\InformationResponse;

/**
 * Клиент для получения информации из CRM
 */
class Http implements ClientInterface
{
    /**
     * Клиент для отправки запросов
     *
     * @var \GuzzleHttp\Client
     */
    private Client $client;

    /**
     * Конструктор
     */
    public function __construct()
    {
        $this->client = new Client(config('crm-info.client'));
    }

    /**
     * Возвращает информацию о проекте из CRM
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInfo(): InformationResponse
    {
        return new InformationResponse(
            $this->client->request('GET', '/api/v1/information')
        );
    }
}
