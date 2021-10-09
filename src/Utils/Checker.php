<?php declare(strict_types=1);

namespace App\Utils;

use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Pangrams, anagrams and palindromes
 *
 * Implement each of the functions of the Checker class.
 * Aim to spend about 10 minutes on each function.
 */
class Checker
{
    /**
     * A palindrome is a word, phrase, number, or other sequence of characters
     * which reads the same backward or forward.
     *
     * @param string $word
     * @return bool
     */
    public function isPalindrome(string $word): bool
    {
        $word = strtolower($word); //change the all letters to lowercase
        if (strrev($word) == $word) return true;
        else return false;
    }

    /**
     * An anagram is the result of rearranging the letters of a word or phrase
     * to produce a new word or phrase, using all the original letters
     * exactly once.
     *
     * @param string $word
     * @param string $comparison
     * @return bool
     */
    public function isAnagram(string $word, string $comparison): bool
    {
        return $this->splitString($word) === $this->splitString($comparison);
    }

    private function splitString($string)
    {
        $s = str_split(preg_replace('/\s+/', '', mb_strtolower($string)));
        sort($s);
        return $s;
    }

    /**
     * A Pangram for a given alphabet is a sentence using every letter of the
     * alphabet at least once.
     *
     * @param string $phrase
     * @return bool
     */
    public function isPanGram(string $phrase): bool
    {
        $sentence = strtolower(trim($phrase));
        $letters = str_split("thequickbrownfoxjumpsoverthelazydog");

        foreach ($letters as $letter)
            if (!strstr($sentence, $letter)) return false;

        return true;
    }

    /**
     * @param string $string
     * @return array
     */
    public static function isThereAWord(string $string): array
    {
        try {
            if (empty($string))
                return [
                    "success" => false,
                    "message" => "String Is Empty!",
                    "data" => [],
                    "errors" => []
                ];

            return [
                "success" => true,
                "message" => "Validation Passed!",
                "data" => [],
                "errors" => []
            ];

        } catch (Exception $e) {
            //Here We should log the traces // We can dump the traces in mongodb
            return [
                "success" => false,
                "message" => "Something went wrong!",
                "data" => [],
                "errors" => $e->getMessage()
            ];
        }
    }
}