<?php 

namespace CorePHP\Log\Formatters;

abstract class AbstractFormatter
{
    /**
     * @var array keys to replace in log format
     */
    protected $formatKeys;

    /**
     * @var string Log string composed by formatKyes
     */
    protected $format;

    /**
     * Auto executable function lo fortmat the log
     * 
     * @param string $level Log level
     * @param string $text Log text
     * @param string $name='' Logger name
     * @param array  $extras=[] Extra data to log
     * @return void
     */
    public function __invoke($level, $text, $name='', $extras=[])
    {
        return $this->format($level, $text, $name, $extras);
    }

    /**
     * Set the format string using the format keys provided by de formatter
     * 
     * @param string $format
     * @return void
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * Return the posible format keys and variations
     * 
     * @return array
     */
    public function getFormatKeys()
    {
        return $this->formatKeys;
    }

    /**
     * Main function to farmat string log
     * 
     * @param string $level Log level
     * @param string $text Log text
     * @param string $name='' Logger name
     * @param array  $extras=[] Extra data to log
     * @return void
     */
    public abstract function format($level, $text, $name='', $extras=[]);
}