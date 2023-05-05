<?php
/**
 * The scanner for the server IPs of HAIO.IR website.
 * 
 * @author       Nabi KaramAliZadeh
 * @website      www.Nabi.ir
 * @email        nabikaz@gmail.com
 * @Twitter      @NabiKAZ
 * @package      haio.ir-ip-scanner
 * @version      1.0.0
 * @copyright    2023 Nabi K.A.Z. , All rights reserved.
 * @license      GNU General Public License v3.0
 */

$email = '<YOUR-USERNAME>';
$password = '<YOUR-PASSWORD>';
$country = 'All'; //All, France, Turkey, Canada, ...
$baseUrl = 'https://api.haio.ir';
$port = 2280;
$timeout = 0.3; //sec

$result = getUrl($baseUrl . '/v1/user/login', ['email' => $email, 'password' => $password]);
$token = $result['params']['data']['access_token'];

$result = getUrl($baseUrl . '/v1/cloud/location', [], ['Authorization' => 'Bearer ' . $token]);
$names = array_column($result['params']['data'], 'country_name_latin');
echo 'Servers: ' . implode(', ', $names) . PHP_EOL . PHP_EOL;

$oks = [];
foreach ($result['params']['data'] as $item) {
    $countryName = $item['country_name_latin'];
    if (strtolower($countryName) != strtolower($country) && strtolower($country) != 'all') continue;

    echo '> Country: ' . $countryName . ' ... ';
    if (strtolower($countryName) == 'iran') {
        echo 'Skipped.' . PHP_EOL;
        continue;
    }

    $result = getUrl($baseUrl . '/v1/cloud/ip/address?location=' . strtolower($countryName), [], ['Authorization' => 'Bearer ' . $token]);
    $ips = $result['params']['data'];
    echo count($ips) . ' items.' . PHP_EOL;

    foreach ($ips as $ip) {
        $host = $ip['ip_address'];
        echo 'Host: ' . $host . ':' . $port . ' ... ';
        $connection = @fsockopen($host, $port, $errno, $errstr, $timeout);
        if (is_resource($connection)) {
            echo '*** OPEN ***' . PHP_EOL;
            $oks[] = $host . ' (' . $countryName . ')';
            fclose($connection);
        } else {
            echo 'CLOSED.' . PHP_EOL;
        }
    }
}


echo PHP_EOL . 'ALL OKs:' . PHP_EOL;
foreach ($oks as $ok) {
    echo $ok . PHP_EOL;
}
echo PHP_EOL;


function getUrl($url, $payload = [], $header = [])
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if ($payload) {
        $payload = json_encode($payload);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    }

    $headers = array();
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0';
    $headers[] = 'Accept: application/json, text/plain, */*';
    $headers[] = 'Accept-Language: en-US,en;q=0.5';
    $headers[] = 'Accept-Encoding: gzip, deflate, br';
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Origin: https://console.haio.ir';
    $headers[] = 'Connection: keep-alive';
    $headers[] = 'Referer: https://console.haio.ir/';
    $headers[] = 'Sec-Fetch-Dest: empty';
    $headers[] = 'Sec-Fetch-Mode: cors';
    $headers[] = 'Sec-Fetch-Site: same-site';
    if ($header) {
        foreach ($header as $key => $val) {
            $headers[] = $key . ': ' . $val;
        }
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch) . PHP_EOL;
    }
    curl_close($ch);

    $result = json_decode($result, true);

    if ($result['status']) {
        return $result;
    } else {
        //return false;
        die('Error to get the data from URL.' . PHP_EOL);
    }
}
