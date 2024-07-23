<?php

namespace PhotoDNA;

class Configuration
{
    public const DEFAULT_ENDPOINT = 'https://api.microsoftmoderator.com/photodna/v1.0/';
    protected string $apiKey;
    protected string $endpoint;
    protected string $ncmecUsername;
    protected string $ncmecPassword;

    public function __construct(
        string $apiKey, 
        string $endpoint = self::DEFAULT_ENDPOINT,
        ?string $ncmecUsername = null,
        ?string $ncmecPassword = null,
    ) {
        $this->setApiKey($apiKey);
        $this->setEndpoint($endpoint);

        if (isset($ncmecUsername, $ncmecPassword)) {
            $this->setNcmecUsername($ncmecUsername);
            $this->setNcmecPassword($ncmecPassword);
        }
    }

    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    public function setEndpoint(string $endpoint): void
    {
        $this->endpoint = $endpoint;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function setNcmecUsername(string $username): void
    {
        $this->ncmecUsername = $username;
    }

    public function setNcmecPassword(string $password): void
    {
        $this->ncmecPassword = $password;
    }

    public function getNcmecUsername(): string
    {
        return $this->ncmecUsername;
    }

    public function getNcmecPassword(): string
    {
        return $this->ncmecPassword;
    }
}