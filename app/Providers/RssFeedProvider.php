<?php

    namespace App\Providers;
    use GuzzleHttp\Client;

    class RssFeedProvider {
        static function getFeed () {
            $url = 'http://feeds.feedburner.com/TechCrunch/Gaming?format=xml';
            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => $url,
                // You can set any number of default request options.
                'timeout'  => 2.0,
            ]);
            $responseObj = $client->get('')->getBody()->getContents();
            $xml = simplexml_load_file($url);
            $items = $xml->xpath('//item');
            return $items;
        }
    }

?>
