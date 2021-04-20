<?php

namespace CSWeb\Galaxpay;

use GuzzleHttp\{Client as Http, Psr7\Request};
use Psr\Log\LoggerInterface;

/**
 * Galaxpay
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @package CSWeb\Galaxpay
 */
class Galaxpay
{
    public const WEBSERVICE_ADDRESS = 'https://app.galaxpay.com.br';

    protected Credentials $credentials;

    protected ?LoggerInterface $logger;

    protected string $endpoint;

    protected bool $sandbox;

    public function __construct(Credentials $credentials, LoggerInterface $logger = null)
    {
        $this->credentials = $credentials;
        $this->logger      = $logger;
    }

    protected function resolveEndpointUrl(string $method): string
    {
        return self::WEBSERVICE_ADDRESS . '/webservice/' . $method;
    }

    protected function formatRequestBody(array $data): string
    {
        $request = [
            'Auth' => [
                'galaxId'   => $this->credentials->getClientId(),
                'galaxHash' => $this->credentials->getClientSecret(),
            ],
        ];

        if (!empty($data)) {
            $request['Request'] = $data;
        }

        return json_encode($request);
    }

    protected function execute(string $endpoint, array $data, string $verb = 'GET'): array
    {
        $http    = new Http();
        $request = new Request(
            $verb,
            $this->resolveEndpointUrl($endpoint),
            [],
            $this->formatRequestBody($data)
        );

        $response = $http->send($request);
        $content  = json_decode($response->getBody()->getContents(), true);

        if ($content['type'] == false) {
            throw new GalaxpayException($content['message']);
        }

        return $content;
    }
}