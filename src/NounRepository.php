<?php

namespace SyntaxScribe\GamingNameGenerator;

class NounRepository
{
    private $nouns;

    public function __construct($filename = 'nouns.txt')
    {
        $this->nouns = file($filename, FILE_IGNORE_NEW_LINES);
    }

    public function getRandomNoun()
    {
        $nouns = $this->nouns;
        if (is_array($nouns)) {
            return [$nouns[array_rand($nouns)]];
        } else {
            return [$nouns];
        }
    }
}