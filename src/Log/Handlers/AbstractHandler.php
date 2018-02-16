<?php

namespace Log\Handlers;

use Log\Formatters\AbstractFormatter;

abstract class AbstractHandler
{
    /**
     * @var AbstractFormatter Log formatter string
     */
    protected $formatter;

    /**
     * @var string Log level
     */
    protected $level;

    /**
     * @var string Logger name
     */
    protected $name;

    /**
     * Set the level of the log
     * 
     * @param string $level Log level
     * @return void
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * Set the name for the log service
     * 
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Set function to formatt the log strong
     * 
     * @param AbstractFormatter $formatter
     * @return string
     */
    public function setFormatt(AbstractFormatter $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * Write log in the context of the handler
     * 
     * @param callable|string $content
     * @param array $extras=[] Extra fields to log
     * @return void
     */
    public abstract function write($content, $extras=[]);
}