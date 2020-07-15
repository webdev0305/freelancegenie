<?php
echo '<pre>';
var_dump(curl_version());
echo '</pre>';
?><?php //die('here');
require __DIR__ . '/vendor/autoload.php';
/*$client = new \Adyen\Client();
$client->setApplicationName("Adyen PHP Api Library Example");
$client->setUsername("admin");
$client->setPassword("abc@123456");
$client->setXApiKey("AQEphmfuXNWTK0Qc+iSWgGE9q+WVS45qCJ1DXfGXmvnAXrn/EmPdDI+Rpl4QwV1bDb7kfNy1WIxIIkxgBw==-XSVZzM5fYZVMgCCHkdi1MO9ysIRI0WfXqP1/LB5zYK8=-MQ3Hhb4d5uqC5X3z");
$client->setEnvironment(\Adyen\Environment::TEST);

$service = new \Adyen\Service\Payment($client);

$json = '{
      "card": {
        "number": "4111111111111111",
        "expiryMonth": "10",
        "expiryYear": "2020",
        "cvc": "737",
        "holderName": "John Smith"
      },
      "amount": {
        "value": 1500,
        "currency": "EUR"
      },
      "reference": "payment-test",
      "merchantAccount": "FreelanceGenieECOM"
}';

$params = json_decode($json, true);

$result = $service->authorise($params);
print_r($result);*/
// Set your X-API-KEY with the API key from the Customer Area.
$client = new \Adyen\Client();
$client->setXApiKey("AQEphmfuXNWTK0Qc+iSWgGE9q+WVS45qCJ1DXfGXmvnAXrn/EmPdDI+Rpl4QwV1bDb7kfNy1WIxIIkxgBw==-XSVZzM5fYZVMgCCHkdi1MO9ysIRI0WfXqP1/LB5zYK8=-MQ3Hhb4d5uqC5X3z");
$client->setEnvironment(\Adyen\Environment::TEST);
$service = new \Adyen\Service\Checkout($client);
 
$params = array(
  "amount" => array(
    "currency" => "USD",
    "value" => 1000
  ),
  "reference" => "1233",
  "paymentMethod" => array(
    "type" => "scheme",
    "number" => "4111111111111111",
    "enxpiryMonth" => "10",
    "expiryYear" => "2020",
    "cvc" => "737",
    "holderName" => "S. Hopper"
  ),
  "returnUrl" => "https://google.com",
  "merchantAccount" => "FreelanceGenieECOM"
);
$result = $service->payments($params);
print_r($result);