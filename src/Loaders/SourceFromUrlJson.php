<?php

namespace XGen\Loaders;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

trait SourceFromUrlJson
{
    /**
     * @return HttpClientInterface
     */
    protected function getClient(): HttpClientInterface
    {
        return HttpClient::create();
    }

    /**
     * @param array $options
     *
     * @return array
     */
    protected function makeArgs(array $options = []): array
    {
        $args = [];
        if (array_key_exists('query', $options)) {
            $args['query'] = $options['query'];
        }

        if (array_key_exists('body', $options)) {
            $args['body'] = $options['body'];
        }
        if (array_key_exists('headers', $options)) {
            $args['headers'] = $options['headers'];
        }

        return $args;
    }

    /**
     * @param string      $url
     * @param string      $method
     * @param array       $options
     * @param string|null $keyViewResult
     */
    public function loadSourceFromUrlJson(string $url, string $method = 'GET', array $options = [], $keyViewResult = null)
    {
        try {
            $response = $this->getClient()->request($method, $url, $this->makeArgs($options));

            $result = json_decode($response->getContent(), true);
            if (array_key_exists($keyViewResult, $result)) {
                return $result[$keyViewResult];
            }

            return $result;
        } catch (\Exception $th) {
            return null;
        }
    }

    public function addSourceFromUrlJson(string $url, string $method = 'GET', array $options = [], $keyViewResult = null)
    {
        $source = $this->loadSourceFromUrlJson($url, $method, $options, $keyViewResult);

        if (null !== $source) {
            $this->addSource($source);
        }

        return $this;
    }
}
