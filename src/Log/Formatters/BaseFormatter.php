<?php

namespace Log\Formatters;

class BaseFormatter extends AbstractFormatter
{
    /**
     * @var array Available formatting keys
     */
    const FORMAT_KEYS = [
        '{epoch}',
        '{epochmilli}',
        '{time}',
        '{datetime}',
        '{message}',
        '{extras}',
        '{level}'
    ];

    /**
     * Construct
     * 
     * @param string $format Log format string
     */
    public function __construct($format='')
    {
        $this->formatKeys = self::FORMAT_KEYS;

        if (empty($format)) {
            $this->format = "[{datetime}] {name} {level} {message} {extras}";
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
            '{date}'       => date('Y-m-d'),
            '{datetime}'   => date('Y-m-d H:i:s'),
            '{message}'    => $text,
            '{extras}'     => $this->makeExtraFields($extras),
            '{level}'      => strtoupper($level),
            '{name}'       => $name
        ];

        return $this->replaceKeys($this->format, $data) . "\n";
    }
}