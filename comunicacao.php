<?php
require_once 'vendor/autoload.php'; // autoload do Composer
use Abraham\TwitterOAuth\TwitterOAuth; // Para utilizar a classe TwitterOAuth
$consumerKey = 'ConsumerKey'; //a consumer key do seu app twitter
$consumerSecret = 'ConsumerSecret'; //a consumer secret do seu app twitter 
$accessToken = 'AccessToken'; //o access token do seu app twitter
$accessTokenSecret = 'AccessTokenSecret'; //o access token secret do seu app twitter
$botToken = 'BotToken'; //o seu bot Token do Telegram
$apiUrl = 'https://api.telegram.org/bot'.$botToken.'/'; //aqui é só para a url da chamada do telegram ficar mais apresentável
$chatId = 'id'; //o id da sua conta no telegram
$connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret); //cria a conexão com a conta do twitter
$statuses = $connection->get("statuses/user_timeline", ["screen_name" => "imasters"]); //retorna os 20 últimos tweets de um usuário, no caso como exemplo do usuário imasters
/* Abaixo uma pequena lógica para pegar apenas os tweets que ainda não foram enviados 
* ao chat. No caso, definimos o primeiro id como 1, e utilizaremos o arquivo id para 
* armazenar os próximos ids. E, vamos verificar qual é o id do último tweet que a conta fez
* enquanto o número armazenado no arquivo for menor que o último tweet. Então o 
* sistema enviará uma requisição para a API do telegram disparar o tweet. Caso o id do 
* último tweet seja igual ao último id armazenado no arquivo, não fará nada
$ultimoId = file_get_contents('id'); //retorna o último id armazenado no arquivo
$i = 19; //inicia o contador decremental de tweets
$ultimoIdNovo = $statuses[0]->id; //recebe o id do último tweet
$id = $statuses[$i]->id; //recebe o id do primeiro tweet do retorno
while ( $i>=0 ) { //enquanto o contador não for menor que 0
if ($id > $ultimoId) { //caso o id do tweet seja maior que o id armazenado no arquivo
 $url = $apiUrl.'sendMessage?chat_id='.$chatId.'&text='.urlencode($statuses[$i]->text); //url referente a API do Telegram para enviar uma mensagem para o chat do seu usuário do telegram com o texto sendo o tweet.
 $x = file_get_contents($url); //faz uma requisição a API do telegram
 }
 $i--; //decrementa o contador
 $id = $statuses[$i]->id; //recebe o id do próximo tweet
}
file_put_contents('id', $ultimoIdNovo); //armazena o id do último tweet enviado
*/30 * * * * php /var/www/console/telegram/telegram.php
