
 <?php
  require 'vendor/autoload.php';
  
  use GuzzleHttp\Client;
  
  $baseUrl = "https://api.openweathermap.org";
  $appid = '6fae349520ed73e7549b0f618a89db37';
  $id ='3468879';
  
  $client = new Client(array('base_uri' => $baseUrl));
  
  
  
  $response = $client->get('/data/2.5/weather', array(
      'query' => array('appid' => $appid, 'id' => $id)
     
  ));
   print_r($response);
   
 ?>
 
