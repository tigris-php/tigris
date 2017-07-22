<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Tigris\Telegram\Exceptions\ApiException;
use Tigris\Telegram\Helpers\TypeHelper;
use Tigris\Telegram\Types\Interfaces\TypeInterface;

class ApiClient
{
    /** @var string */
    protected $apiToken;
    /** @var \GuzzleHttp\Client */
    protected $client;

    public function __construct(Client $client)
    {
        $this->setClient($client);
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param mixed $apiToken
     */
    public function setApiToken($apiToken)
    {
        $this->apiToken = $apiToken;
    }

    /**
     * @param $methodName
     * @param null|array $params
     * @return mixed
     */
    public function call($methodName, $params = [])
    {
        if (empty($this->apiToken)) {
            throw new \BadMethodCallException('Api token is not configured');
        }

        // removing empty params
        $query = array_filter($params);

        // detecting if we need to use multipart/form-data
        $multipart = array_reduce($params, function ($carry, $item) {
            return $carry || is_resource($item);
        }, false);

        // converting existing types to arrays if needed
        array_walk($query, function (&$item) {
            if ($item instanceof TypeInterface) {
                $item = TypeHelper::jsonEncode($item, false);
            }
        });

        if ($multipart) {
            $query = array_map(function ($key, $item) {
                return [
                    'name' => $key,
                    'contents' => $item,
                ];
            }, array_keys($params), $params);
            $options = array_filter([
                'multipart' => $query,
            ]);
        } else {
            $options = array_filter([
                'json' => $query,
            ]);
        }

        $uri = 'https://api.telegram.org/bot' . $this->apiToken . '/' . $methodName;
        $response = $this->client->post($uri, $options);
        return $this->parseResponse($response);
    }

    /**
     * @param ResponseInterface $response
     * @return mixed
     * @throws ApiException
     */
    protected function parseResponse(ResponseInterface $response)
    {
        $data = json_decode($response->getBody()->getContents(), true);
        if ($data === null || $data['ok'] != true) {
            throw new ApiException('Request failure');
        }

        return $data['result'];
    }
}