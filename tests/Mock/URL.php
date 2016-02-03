<?php

/**
 * Makes the mock for URL
 */
class URL
{
    static public function action($url, $parameters)
    {
        $array = explode("@", $url);
        $url = "test:".end($array);

        // add parameters for testing
        if (count($parameters)) {
            $url .= ":" . implode(":", $parameters);
        }
        return $url;
    }
}