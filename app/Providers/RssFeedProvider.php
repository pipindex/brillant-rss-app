<?php

    namespace App\Providers;
    use GuzzleHttp\Client;
    use Log;
    use Exception;

    class RssFeedProvider {
        static function getFeed () {
            ini_set('memory_limit', -1); // just in case there's LOTS of data!!
            $url = 'http://feeds.feedburner.com/TechCrunch/Gaming?format=xml';
            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => $url,
                // You can set any number of default request options.
                'timeout'  => 2.0,
            ]);
            try {
                $responseObj = $client->get('')->getBody()->getContents();
            }
            catch (\Exception $e) {
                Log::error("Failed to fetch XML");
            }
            $xml = simplexml_load_string($responseObj);
            $items = $xml->xpath('//item');
            $titles = $xml->xpath('//title');
            return $items;
        }
    }

?>
