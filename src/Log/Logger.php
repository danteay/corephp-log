<?php

namespace CorePHP\Log;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use CorePHP\Log\Handlers\HandlerInterface;
use CorePHP\Log\Handlers\AbstractHandler;

class Logger implements LoggerInterface
{
    /**
     * @var array List of handlers for log information
     */
    private $handlers;

    /**
     * @var string Name for the logger
     */
    private $name;

    /**
     * Constructor
     * 
     * @param string $name Logger name
     */
    public function __construct($name='EasyLog')
    {
        $this->name = $name;
        $this->handlers = [];
    }

    /**
     * Return the logger name
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add New Handler to execute
     * 
     * @param AbstractHandler $handler
     */
    public function addHandler(AbstractHandler $handler)
    {
        $this->handlers[] = $handler;
    }

    /**
     * Return the current registered handlers
     * 
     * @return array
     */
    public function getHandlers()
    {
        return $this->handlers;
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function emergency($message, array $context = array())
    {
        if (empty($context)) {
            $context = $this->handlers;
        }

        foreach ($context as $current) {
            $current->setLevel(LogLevel::EMERGENCY);
            $current->setName($this->getName());
            $current->write($message);
        }
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function alert($message, array $context = array())
    {
        if (empty($context)) {
            $context = $this->handlers;
        }

        foreach ($context as $current) {
            $current->setLevel(LogLevel::ALERT);
            $current->setName($this->getName());
            $current->write($message);
        }
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function critical($message, array $context = array())
    {
        if (empty($context)) {
            $context = $this->handlers;
        }

        foreach ($context as $current) {
            $current->setLevel(LogLevel::CRITICAL);
            $current->setName($this->getName());
            $current->write($message);
        }
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function error($message, array $context = array())
    {
        if (empty($context)) {
            $context = $this->handlers;
        }

        foreach ($context as $current) {
            $current->setLevel(LogLevel::ERROR);
            $current->setName($this->getName());
            $current->write($message);
        }
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function warning($message, array $context = array())
    {
        if (empty($context)) {
            $context = $this->handlers;
        }

        foreach ($context as $current) {
            $current->setLevel(LogLevel::WARNING);
            $current->setName($this->getName());
            $current->write($message);
        }
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function notice($message, array $context = array())
    {
        if (empty($context)) {
            $context = $this->handlers;
        }

        foreach ($context as $current) {
            $current->setLevel(LogLevel::NOTICE);
            $current->setName($this->getName());
            $current->write($message);
        }
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @override
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function info($message, array $context = array())
    {
        if (empty($context)) {
            $context = $this->handlers;
        }

        foreach ($context as $current) {
            $current->setLevel(LogLevel::INFO);
            $current->setName($this->getName());
            $current->write($message);
        }
    }

    /**
     * Detailed debug information.
     *
     * @override
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function debug($message, array $context = array())
    {
        if (empty($context)) {
            $context = $this->handlers;
        }

        foreach ($context as $current) {
            $current->setLevel(LogLevel::DEBUG);
            $current->setName($this->getName());
            $current->write($message);
        }
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param string $level
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function log($level, $message, array $context = array())
    {
        $this->$level($message, $context);
    }
}