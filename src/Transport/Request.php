<?php

namespace PhotoDNA\Transport;

use PhotoDNA\Configuration;
use GuzzleHttp\Client;

class Request
{
    protected Configuration $configuration;

    protected array $parameters;

    protected string $method;

    protected $file;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    protected function getHttpClient(): Client
    {
        return new Client([
            'base_uri' => $this->configuration->getEndpoint(),
            'headers' => $this->getAuthentication(),
        ]);
    }

    protected function getAuthentication(): array
    {
        return [
            'Ocp-Apim-Subscription-Key' => $this->configuration->getApiKey(),
        ];
    }

    public function setMethod(string $method): Request
    {
        $this->method = $method;
        return $this;
    }

    public function setParameters(array $parameters): Request
    {
        $this->parameters = $parameters;
        return $this;
    }

    public function setFile($file): Request
    {
        $this->file = $file;
        return $this;
    }

    public function execute(): Response
    {
        return new Response(
            $this->getHttpClient()->request(
                'POST',
                $this->method,
                ['body' => $this->file ?? $this->parameters]
            )
        );
    }
}