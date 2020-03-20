<?php
/**
 * Super simple php-example to access instagram without any API key.
 * Grab profile information and image urls from a JSON-object in the instagram webcode.
 * 
 * Author:  Dennis Paul
 * Contact: dennis@blaumedia.com
 */

const USERNAME = 'github';
const USER_AGENT = 'public-instagram-profile-parser; https://github.com/3lue/public-instagram-profile-parser';

header('Content-Type: application/json');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.instagram.com/' . USERNAME . '/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERAGENT, USER_AGENT);

if (preg_match('/window\._sharedData = (.*);<\/script>/', curl_exec($ch), $data) === 1) {
    $data = json_decode($data[1], 1);
    if ($data !== null) {
        echo json_encode($data['entry_data']['ProfilePage'][0]['graphql']['user']);
    } else {
        echo json_encode([
            'success' => false
        ]);
    }
} else {
    echo json_encode([
        'success' => false
    ]);
}

curl_close($ch);
?>
