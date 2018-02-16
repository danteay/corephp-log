<?php

namespace Log\Handlers;

use Psr\Log\InvalidArgumentException;
use Log\Utils\FormatTrait;

class FileHandler extends AbstractHandler
{
    use FormatTrait;

    /**
     * @var resource file handler
     */
    private $file;

    /**
     * @var string resource file path
     */
    private $filePath;

    /**
     * Constructor
     */
    public function __construct($filepath)
    {
        $this->filePath = $filepath;
        //$this->file = fopen($filepath, 'w');
        $this->formatter = null;
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
            $tmp = $this->makeExtraFields($extras);
            $final = $text . ' ' . $tmp . PHP_EOL;
            file_put_contents($this->filePath, $final, FILE_APPEND);
        } else {
            $text_formated = call_user_func(
                $this->formatter, 
                $this->level, 
                $text, 
                $this->name, 
                $extras
            );

            file_put_contents($this->filePath, $text_formated, FILE_APPEND);
        }

    }
}