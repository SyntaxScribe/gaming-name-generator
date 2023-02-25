<?php

namespace MonoVM\GamingNameGenerator;

class NounRepository
{
    private $nouns;

    public function __construct($filename)
    {
        $this->nouns = file($filename, FILE_IGNORE_NEW_LINES);
    }

    public function getRandomNoun()
    {
        return $this->nouns[array_rand($this->nouns)];
    }
}