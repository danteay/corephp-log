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
        $bodyLegth = isset($extras['bodyLength']) ? function() use ($extras) {
            $tmp = $extras['bodyLength'];
            unset($extras['bodyLength']);
            return $tmp;
        } : '0';

        $reqTime = isset($extras['reqTime']) ? function() use ($extras){
            $tmp = $extras['reqTime'];
            unset($extras['reqTime']);
            return $tmp;
        } : '0';

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
            '{bodyLength}' => is_callable($bodyLegth) ? $bodyLegth() : $bodyLegth,
            '{reqTime}'    => is_callable($reqTime) ? $reqTime() : $reqTime,
            '{message}'    => $text,
            '{extras}'     => FormatUtil::makeExtraFields($extras)
        ];

        return FormatUtil::replaceKeys($this->format, $data) . "\n";
    }
}