<?php

namespace App\Tests\util;

use http\Client;
use PHPUnit\Exception;
use Symfony\Bundle\FrameworkBundle;
use Symfony\Component\HttpClient\AmpHttpClient;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ClientFactory
{
    /**
     * Create a client with a default Authorization header.
     *
     * @param string $username
     * @param string $password
     *
     * @return HttpClientInterface
     * @throws TransportExceptionInterface
     */
    public static function createAuthenticatedClient($email = 'admin@gmail.com', $password = '123456!Aa')
    {
        /**
         * @var AmpHttpClient $client
         */
        $client = HttpClient::create();
        $response = $client->request(
            'POST',
            'http://localhost:8000/api/login_check',
            [
                'headers' => [
                    'CONTENT_TYPE' => 'application/json'
                ],
                'body' => json_encode([
                    'email' => $email,
                    'password' => $password,
                ])
            ]
        );

        try {

            $data = json_decode($response->getContent(), true);

            return HttpClient::create(['headers' => [
                'Authorization' => 'Bearer '.$data['token']
            ]]);
        } catch (ClientExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface|TransportExceptionInterface $e) {
            dump($e);
        }

        return $client;
    }


}