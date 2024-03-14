<?php

namespace Ir\Crminfo\Client\Response;

use Psr\Http\Message\ResponseInterface;

class InformationResponse
{
    /**
     * Код ответа API
     *
     * @var int
     */
    protected int $statusCode;

    /**
     * Данные ответа
     *
     * @var array
     */
    protected array $contents;

    public function __construct(ResponseInterface $response)
    {
        $this->statusCode = $response->getStatusCode();

        $this->setContents($response->getBody()->getContents());
    }

    /**
     * Заполняет свойство contents сырыми данными ответа
     *
     * @param  string                                          $contents
     * @return \Ir\Crminfo\Client\Response\InformationResponse
     */
    public function setContents(string $contents): self
    {
        $this->contents = json_decode($contents, true);

        return $this;
    }

    public function getContents(): array
    {
        return $this->contents;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
