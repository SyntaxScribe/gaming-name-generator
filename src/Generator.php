<?php

namespace SyntaxScribe\GamingNameGenerator;

class Generator
{
    private $adjectiveRepo;
    private $nounRepo;
    private $usedAdjectives = [];
    private $usedNouns = [];
    private $usePrefix;
    private $useSuffix;

    public function __construct(AdjectiveRepository $adjectiveRepo, NounRepository $nounRepo, $usePrefix = false, $useSuffix = false)
    {
        $this->adjectiveRepo = $adjectiveRepo;
        $this->nounRepo = $nounRepo;
        $this->usePrefix = $usePrefix;
        $this->useSuffix = $useSuffix;
    }

    public static function generate($usePrefix = false, $useSuffix = false)
    {
        $adjectiveRepo = new AdjectiveRepository();
        $nounRepo = new NounRepository();
        $generator = new self($adjectiveRepo, $nounRepo, $usePrefix, $useSuffix);
        return $generator->generateName();
    }

    public function generateName()
    {
        $adjCount = count($this->adjectiveRepo->getRandomAdjective());
        $nounCount = count($this->nounRepo->getRandomNoun());
        $maxCombos = $adjCount * $nounCount;

        $count = 0;
        do {
            $count++;
            if ($count > $maxCombos) {
                return false;
            }
            $adj = $this->getRandomWord($this->adjectiveRepo->getRandomAdjective(), $this->usedAdjectives);
        } while ($adj === false);
        do {
            $noun = $this->getRandomWord($this->nounRepo->getRandomNoun(), $this->usedNouns);
        } while ($noun === false);

        $this->usedAdjectives[$adj] = true;
        $this->usedNouns[$noun] = true;

        if ($this->usePrefix) {
            $prefixes = ["Super", "Mega", "Ultra", "Hyper", "Max"];
            $prefix = $prefixes[array_rand($prefixes)];
            $adj = $prefix . $adj;
        }

        if ($this->useSuffix) {
            $suffixes = ["er", "ian", "ist", "man", "woman"];
            $suffix = $suffixes[array_rand($suffixes)];
            $noun = $noun . $suffix;
        }

        return ucfirst($adj) . ucfirst($noun);
    }

    private function getRandomWord($words, $usedWords)
    {
        $availableWords = array_diff($words, array_keys($usedWords));

        if (count($availableWords) == 0) {
            return false;
        }

        $index = mt_rand(0, count($availableWords) - 1);
        return $availableWords[$index];
    }
}
