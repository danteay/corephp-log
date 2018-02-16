<?php

namespace CorePHP\Log\Utils;

use Psr\Log\LogLevel;

class LevelUtils
{
    /**
     * @var array Rank for the log level 
     */
    const LEVEL_RANKS = [
        LogLevel::DEBUG     => 1,
        LogLevel::INFO      => 2,
        LogLevel::NOTICE    => 3,
        LogLevel::WARNING   => 4,
        LogLevel::ERROR     => 5,
        LogLevel::CRITICAL  => 6,
        LogLevel::ALERT     => 7,
        LogLevel::EMERGENCY => 8
    ];

    /**
     * Return all the log level ranks
     * 
     * @return array
     */
    public static function getRanks()
    {
        return self::LEVEL_RANKS;
    }

    /**
     * Return the rank of a specific log level
     * 
     * @param string $level Level name
     * @return int
     */
    public static function getLevelRank($level)
    {
        return self::LEVEL_RANKS[$level];
    }
}