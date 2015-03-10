<?php
namespace LaunchDarkly;

use GuzzleHttp\Client;

/**
 * @internal
 */
class EventProcessor {

  private $_apiKey;
  private $_queue;
  private $_capacity;
  private $_timeout;
  private $_socket_failed;
  private $_host;
  private $_port;
  private $_ssl;

  public function __construct($apiKey, $httpClient, $options = []) {
    $this->_apiKey = $apiKey;
    $this->_httpClient = $httpClient;
    if (!isset($options['base_uri'])) {
        $this->_host = 'app.launchdarkly.com';
        $this->_port = 443;
        $this->_ssl = true;
    } 
    else {
        $url = parse_url($options['base_uri']);
        $this->_host = $url['host'];
        $this->_ssl = $url['scheme'] === 'https';
        if (isset($url['port'])) {
          $this->_port = $url['port'];
        } 
        else {
          $this->_port = $this->_ssl ? 443 : 80;
        }
    }

    $this->_capacity = $options['capacity'];
    $this->_timeout = $options['timeout'];

    $this->_queue = array(); 
    $this->_pending = array(); 
  }

  public function __destruct() {
    $this->flush();
    foreach ($this->_pending as $req) {
      $req->wait();
    }
  }

  public function sendEvent($event) {
    $this->enqueue($event);
    return true;
  }

  public function enqueue($event) {
    if (count($this->_queue) > $this->_capacity) {
      return false;
    }

    array_push($this->_queue, $event);
    $newReq = $this->flush();
    array_push($this->_pending, $newReq);

    return true;
  }

  protected function flush() {
    if (empty($this->_queue)) {
      return;
    }

    $payload = json_encode($this->_queue);
    $this->_queue = array();

    return $this->makeRequest($payload);
  }

  private function makeRequest($payload) {
    return $this->_httpClient->post("/api/events/bulk", ['body' => $payload, 'future' => true]);
  }


}