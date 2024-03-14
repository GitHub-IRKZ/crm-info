<?php declare(strict_types=1);

namespace Ir\Crminfo\Client;

use Ir\Crminfo\Client\Response\InformationResponse;

/**
 * Mock клиента для получения информации из CRM
 */
class Mock implements ClientInterface
{
    /**
     * Получает информацию о проекте из CRM
     *
     * @return \Ir\Crminfo\Client\Response\InformationResponse
     */
    public function getInfo(): InformationResponse
    {
        return new InformationResponse(
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '{'.
                    '"companyName":"TOO \"IR.KZ\" ru 2",'.
                    '"companyPhone":"+7 (7172) 69-79-19",'.
                    '"companyMobile":"+7 (701) 274-19-192",'.
                    '"supportSite":"https:\/\/support.ir.kz"'.
                '}'
            )
        );
    }
}
