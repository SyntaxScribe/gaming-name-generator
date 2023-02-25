<?php

namespace SyntaxScribe\GamingNameGenerator;

class AdjectiveRepository
{
    private $adjectives;

    public function __construct($filename = 'adjectives.txt')
    {
        $this->adjectives = file($filename, FILE_IGNORE_NEW_LINES);
    }

    public function getRandomAdjective()
    {
        $adjectives = $this->adjectives;
        if (is_array($adjectives)) {
            return [$adjectives[array_rand($adjectives)]];
        } else {
            return [$adjectives];
        }
    }
}