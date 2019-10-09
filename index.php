
 <?php
  require 'vendor/autoload.php';
  
  use GuzzleHttp\Client;
  use GuzzleHttp\Exception\ClientException;
  
  $baseUrl = "http://api.openweathermap.org";
  $appid = '6fae349520ed73e7549b0f618a89db37';
  $id ='3468879';
  
// RECUPERA A DATA DE CRIAÇÃO DOS DADOS.
  $dataCriacao = file_get_contents('cache/validade_tempo.txt');
  
  if(time() - $dataCriacao>= 300){
  
  try{
  $client = new Client(array('base_uri' => $baseUrl));
  $response = $client->get('/data/2.5/weather', array(
      'query' => array('appid' => $appid, 'id' => $id)    
  )); 
  //echo $response->getBody(); 
  
  $tempo = json_decode($response->getBody());
  $dadosSerializados = serialize($tempo);
  file_put_contents('cache/dados_tempo.txt', $dadosSerializados);//Grava o arquivo
  file_put_contents('cache/validade_tempo.txt', time());//Grava o arquivo 

  } catch (ClientException $e){
      echo 'Falha ao obter informações !!!';
  }
  } else {
      $dadosSerializados = file_get_contents('cache/dados_tempo.txt');
      $tempo = unserialize($dadosSerializados);
}
 echo 'Temperatura atual ',$tempo->main->temp-273,' °c ' ,"....";
  echo '<br>';
  echo 'Pressão  ',$tempo->main->pressure-273,' °p ',"....";
  echo '<br>';
  echo 'Humidade ',$tempo->main->humidity,' % umidade ',"....";
  echo '<br>';
  echo 'Temperatura min. ',$tempo->main->temp_min-273,' °c ',"....";
  echo '<br>';
  echo 'Temperatura max. ',$tempo->main->temp_max-273,' °c ',"....";
  
 ?>
 
