<?php

namespace CorePHP\Log\Formatters;

use CorePHP\Log\Utils\FormatUtil;

class WebFormatter extends AbstractFormatter
{
    const FORMAT_KEYS = [
        '{epoch}',
        '{epochmilli}',
        '{time}',
        '{datetime}',
        '{service}',
        '{level}',
        '{code}',
        '{clientIp}',
        '{method}',
        '{path}',
        '{bodyLength}',
        '{reqTime}',
        '{message}',
        '{extras}'
    ];

    /**
     * Construct
     * 
     * @param string $format String format composed by the available format keys
     */
    public function __construct($format='')
    {
        $this->formatKeys = self::FORMAT_KEYS;

        if (empty($format)) {
            $this->format = "{epochmilli} {name} {level} {code} {clientIp} {method} {path} {bodyLength} {reqTime} {message} {extras}";
        } else {
            $this->format = $format;
        }
    }

    /**
     * Main function to farmat string log
     * 
     * @override
     * @param string $level Log level
     * @param string $text Log text
     * @param string $name='' Logger name
     * @param array  $extras=[] Extra data to log
     * @return void
     */
    public function format($level, $text, $name='', $extras=[])
    {
        $data = [
            '{epoch}'      => time(),
            '{epochmilli}' => round(microtime(true) * 1000),
            '{time}'       => date('Y-m-d'),
            '{datetime}'   => date('Y-m-d H:i:s'),
            '{name}'       => $name,
            '{level}'      => strtoupper($level),
            '{code}'       => http_response_code(),
            '{clientIp}'   => $_SERVER['REMOTE_ADDR'],
            '{method}'     => $_SERVER['REQUEST_METHOD'],
            '{path}'       => $_SERVER['REQUEST_URI'],
            '{bodyLength}' => '0',
            '{reqTime}'    => '0',
            '{message}'    => $text
        ];

        foreach ($data as $key => $value) {
            $auxkey = str_replace('{', '', str_replace('}', '', $key));

            if (array_key_exists($auxkey, $extras)){
                $data[$key] = $extras[$auxkey];
                unset($extras[$auxkey]);
            }
        }

        $data['{extras}'] = empty($extras) ? '' : FormatUtil::makeExtraFields($extras);

        return FormatUtil::replaceKeys($this->format, $data) . "\n";
    }
}