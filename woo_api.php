<?php
$store_url = 'https://dev06.purplecommerce.live/woo-02';
$endpoint = '/wc-auth/v1/authorize';
$consumer_key = 'ck_7c25e896c1517f60013f3b1720ab0d68ac64b88a'; // Replace with your Consumer Key
$consumer_secret = 'cs_726322c9b28b4ba9a18dd0320bb934f681375628'; // Replace with your Consumer Secret

$app_name = 'PurpleCommerce';
$scope = 'read_write'; // or 'read', 'write'
$user_id = 1; // Replace with the actual WordPress user ID
$return_url = 'https://seventies.purplecommerce.live/IS_api/return_url.php';
$callback_url = 'https://seventies.purplecommerce.live/IS_api/callback_url.php';

$auth_url = $store_url . $endpoint . '?' . http_build_query([
    'app_name' => $app_name,
    'scope' => $scope,
    'user_id' => $user_id,
    'return_url' => $return_url,
    'callback_url' => $callback_url
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $auth_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $consumer_key . ':' . $consumer_secret);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

$response = curl_exec($ch);
curl_close($ch);

echo '<pre>';
print_r(json_decode($response, true));
echo '</pre>';