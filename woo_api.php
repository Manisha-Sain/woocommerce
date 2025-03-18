<?php
$store_url = 'https://site_url';
$endpoint = '/wc-auth/v1/authorize';
$consumer_key = 'ck_XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'; // Replace with your Consumer Key
$consumer_secret = 'cs_XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'; // Replace with your Consumer Secret


$api_url = 'https://site_url/wp-json/wc/v3/customers';


// Prepare the customer data
$customer_data = array(
    'email' => 'john.doe@example.com',
    'first_name' => 'John',
    'last_name' => 'Doe',
    'billing' => array(
        'first_name' => 'John',
        'last_name' => 'Doe',
        'address_1' => '123 Main St',
        'city' => 'Anytown',
        'state' => 'CA',
        'postcode' => '90210',
        'country' => 'US',
        'email' => 'john.doe@example.com',
        'phone' => '555-555-5555'
    ),
    'shipping' => array(
        'first_name' => 'John',
        'last_name' => 'Doe',
        'address_1' => '123 Main St',
        'city' => 'Anytown',
        'state' => 'CA',
        'postcode' => '90210',
        'country' => 'US'
    )
    );
echo "i am here"; echo '<pre>'; print_r($customer_data); echo '</pre>';//die;
// Initialize cURL
$curl = curl_init();

$fields_array = array(
    CURLOPT_URL => $api_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_POSTFIELDS => json_encode($customer_data),
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json",
    )
);



 curl_setopt_array($curl, $fields_array);
 $response = curl_exec($curl);
//echo $response;

// Check for errors
if (curl_errno($curl)) {
    echo 'Error:' . curl_error($curl);
} else {
    // Decode the response
    $response_data = json_decode($response, true);
    print_r($response_data);
}

// Close cURL
curl_close($curl);
?>
