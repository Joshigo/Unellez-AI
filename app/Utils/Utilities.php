<?php

namespace App\Utils;

class Utilities
{
    public static function getKeywords($text)
    {
        $stopWords = json_decode(file_get_contents(__DIR__ . '/data/stopWords.json'), true)['$stopWords'];
        $words = preg_split('/\s+/', strtolower($text));
        $keywords = array_values(array_filter($words, function ($word) use ($stopWords) {
            return $word !== '' && !in_array($word, $stopWords);
        }));
        return $keywords;
    }
}
