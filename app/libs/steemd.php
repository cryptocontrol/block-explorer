<?php

use JsonRPC\Client;
use JsonRPC\HttpClient;

class steemd
{

  protected $host;
  protected $client;

  public function __construct($host)
  {
    $this->host = $host;
    $httpClient = new HttpClient($host);
    $httpClient->withoutSslVerification();
    $this->client = new Client($host, false, $httpClient);
  }

  public function getAccountHistory($username, $limit = 100, $skip = -1)
  {
    $api = $this->getApi('database_api');
    return $this->client->call($api, 'get_account_history', [$username, $skip, $limit]);;
  }

  public function getProps($username, $limit = 100, $skip = -1)
  {
    $api = $this->getApi('database_api');
    return $this->client->call($api, 'get_dynamic_global_properties', []);
  }

  public function getApi($name)
  {
    return $this->client->call(1, 'get_api_by_name', [$name]);
  }

  public function getFollowing($username, $limit = 100, $skip = -1)
  {
    $api = $this->getApi('follow_api');
    return $this->client->call($api, 'get_following', [$username, $skip, $limit]);;
  }
}
