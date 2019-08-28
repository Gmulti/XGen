<?php

namespace XGen;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Client
{
    use Resources;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * Options for client.
     *
     * @var array
     */
    protected $options;

    /**
     * Http Client.
     *
     * @var HttpClientInterface
     */
    protected $httpClient;

    /**
     * Client constructor.
     *
     * @param string $apiKey  your API key
     * @param array  $options an array of options, currently only "host" is implemented
     */
    public function __construct($apiKey, $options = [])
    {
        $this->apiKey = $apiKey;
        $options['apiKey'] = $apiKey;
        $this
            ->setHttpClient()
            ->setOptions($options)
            ->loadResources();
    }

    /**
     * Default options values.
     *
     * @return array
     */
    public function defaultOptions()
    {
        return [
            'host'  => 'https://apigenerator.gmulti.now.sh',
        ];
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function setOptions($options)
    {
        // merging default options with user options
        $this->options = array_merge($this->defaultOptions(), $options);

        return $this;
    }

    /**
     * @param HttpClientInterface|null $httpClient
     * @param string|null              $customHeader
     *
     * @return $this
     */
    public function setHttpClient($httpClient = null, $defaultOptions = [])
    {
        if (null === $httpClient) {
            $httpClient = HttpClient::create(array_merge([
                'http_version' => '2.0',
            ], $defaultOptions));
        }

        if ($httpClient instanceof HttpClientInterface) {
            $this->httpClient = $httpClient;
        }

        return $this;
    }

    /**
     * @return HttpClientInterface
     */
    public function getHttpClient(): HttpClientInterface
    {
        return $this->httpClient;
    }
}
