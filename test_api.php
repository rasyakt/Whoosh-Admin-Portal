<?php
$url = 'http://localhost/whoossh_api/auth/register.php';
$data = json_encode([
    'name' => 'Rasya Test',
    'email' => 'rasyatest@gmail.com',
    'phone' => '08376434273',
    'password' => '12345678'
]);

$options = [
    'http' => [
        'header'  => "Content-Type: application/json\r\n",
        'method'  => 'POST',
        'content' => $data
    ]
];
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

echo "Response:\n";
var_dump($result);
