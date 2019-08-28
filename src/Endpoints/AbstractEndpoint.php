<?php

namespace XGen\Endpoints;

use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class AbstractEndpoint
{
    public function __construct($client, $options)
    {
        $this->client = $client;
        $this->options = $options;
    }

    /**
     * @return HttpClientInterface
     */
    public function getClient(): HttpClientInterface
    {
        return $this->client;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Make the API call and return the response.
     *
     * @param string $method   Method to use for given endpoint
     * @param string $endpoint Endpoint to hit on API
     * @param array  $body     Body content of the request as array
     * @param bool   $asArray  To know if we return an array or ResponseInterface
     *
     * @return array|ResponseInterface
     *
     * @throws Exception
     */
    public function makeRequest($method, $endpoint, $body = [], $query = [], $asArray = true)
    {
        try {
            $response = $this->getClient()->request($method, $this->makeAbsUrl($endpoint), [
                'query'   => $query,
                'body'    => $body,
                'headers' => [
                    'Authorization' => $this->options['apiKey'],
                ],
            ]);

            $array = json_decode($response->getContent(), true);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        if ($asArray) {
            return $array;
        }

        return [$response->getContent(), $response->getStatusCode(), $response->getHeaders()];
    }

    /**
     * @param string $endpoint
     *
     * @return string
     */
    protected function makeAbsUrl($endpoint): string
    {
        return $this->options['host'] . $endpoint;
    }
}
