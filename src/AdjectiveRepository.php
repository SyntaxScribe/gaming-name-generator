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
        return $this->adjectives[array_rand($this->adjectives)];
    }
}