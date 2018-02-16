<?php

namespace CorePHP\Log\Utils;

class FormatUtil
{
    /**
     * Concatenate extra data
     * 
     * @param array $extras Extra data to concatenate
     * @return string
     */
    public static function makeExtraFields($extras)
    {
        if (!empty($extras)) {
            $aux = '';

            foreach ($extras as $value) {
                $aux = $aux = '' ? $value : ' ' . $value;
            }

            return $aux;
        } 

        return '';
    }

    /**
     * Replace keys in format with the provided data
     * 
     * @param string $text Text for replace keys
     * @param array  $data Log data by format keys
     * @return string
     */
    public static function replaceKeys($text, $data)
    {
        foreach ($data as $key => $value) {
            $text = str_replace($key, $value, $text);
        }

        return $text;
    }
}