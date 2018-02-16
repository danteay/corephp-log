<?php

namespace Log\Handlers;

use Psr\Log\InvalidArgumentException;
use Psr\Log\LogLevel;
use Log\Utils\Colors;

class StdoutHandler extends AbstractHandler
{
    /**
     * @var resource stream handler
     */
    private $stdout;

    /**
     * @var boolean Enable bash colorization text
     */
    private $bash_colors;

    /**
     * Constructor
     */
    public function __construct($bash_colors=false)
    {
        $this->stdout = fopen('php://stdout', 'w');
        $this->formatter = null;
        $this->bash_colors = $bash_colors;
    }

    /**
     * Extende write function of HandlerInterface
     * 
     * @override
     * @param callable|string Content of the log
     * @throws InvalidArgumentException
     * @return void
     */
    public function write($content, $extras=[])
    {
        if (is_callable($content)) {
            $text = $content();
        } else if (is_string($content)) {
            $text = $content;
        } else {
            throw new InvalidArgumentException('Invalid content to handle');
        }

        if (empty($this->formatter)){
            fputs($this->stdout, $text);
        } else {
            $text_formated = call_user_func(
                $this->formatter, 
                $this->level, 
                $text, 
                $this->name,
                $extras
            );

            if ($this->bash_colors) {
                $text_formated = $this->setColorization($text_formated);
            }

            fputs($this->stdout, $text_formated);
        }
    }

    /**
     * Colorize text log acording the log level
     * 
     * @param string $text Information to log
     * @return string
     */
    private function setColorization($text)
    {
        $colors = new Colors();

        switch ($this->level) {
            case LogLevel::EMERGENCY:
            case LogLevel::ALERT:
            case LogLevel::CRITICAL:
                return $colors->getColoredString($text, 'red');
                break;

            case LogLevel::ERROR:
            case LogLevel::WARNING:
                return $colors->getColoredString($text, 'light_red');
                break;
            
            case LogLevel::NOTICE:
                return $colors->getColoredString($text, 'cyan');
                break;
            
            default:
                return $text;
                break;
        }
    }
}