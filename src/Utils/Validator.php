<?php

/*
 * This file contains all the validator.
 *
 * (c) Ashiqur Rahman <raahmansmail@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Utils;

use Exception;
use function Symfony\Component\String\u;
use Symfony\Component\Console\Exception\InvalidArgumentException;

/**
 * This class is used to put all the validators
 * @author Ashiqur Rahman <raahmansmail@gmail.com>
 */
class Validator
{
    /**
     * @param string|null $string
     * @return false[]
     */
    public static function palindromeCheckerValidator(?string $string): array
    {
        try {
            $isThereAWordResponse = Checker::isThereAWord($string);
            if ($isThereAWordResponse['success'])
                return Helper::ResponseProcessor(true, "Validation Successful!");

            return Helper::ResponseProcessor(false,
                !empty($isThereAWordResponse['errors']) ? $isThereAWordResponse['message']
                    : "You need to provide a word to play palindrome string game!",
                [], $isThereAWordResponse['errors']);
        } catch (Exception $e) {
            //Here We should log the traces // We can dump the traces in mongodb
            return Helper::ResponseProcessor(true, "Something went wrong!", [], $e->getMessage());
        }
    }

    /**
     * @param string|null $string
     * @param string|null $comparisonString
     * @return false[]
     */
    public static function anagramCheckerValidator(?string $string, ?string $comparisonString): array
    {
        try {
            $isThereAWordResponse = Checker::isThereAWord($string);
            $isThereAComparisonWordResponse = Checker::isThereAWord($comparisonString);
            if ($isThereAWordResponse['success'] && $isThereAComparisonWordResponse['success'])
                return Helper::ResponseProcessor(true, "Validation Successful!");
            elseif ($isThereAWordResponse['success'])
                return Helper::ResponseProcessor(false, "You need to provide a word in comparison field to play anagram string game!");
            elseif ($isThereAComparisonWordResponse['success'])
                return Helper::ResponseProcessor(false, "You need to provide a word in word field to play anagram string game!");

            return Helper::ResponseProcessor(false,
                !empty($isThereAWordResponse['errors']) ? $isThereAWordResponse['message']
                    : "You need to provide word and comparison string to play anagram string game!",
                [], $isThereAWordResponse['errors']);
        } catch (Exception $e) {
            //Here We should log the traces // We can dump the traces in mongodb
            return Helper::ResponseProcessor(true, "Something went wrong!", [], $e->getMessage());
        }
    }

    /**
     * @param string|null $string
     * @return false[]
     */
    public static function pangramCheckerValidator(?string $string): array
    {
        try {
            $isThereAWordResponse = Checker::isThereAWord($string);
            if ($isThereAWordResponse['success'])
                return Helper::ResponseProcessor(true, "Validation Successful!");

            return Helper::ResponseProcessor(false,
                !empty($isThereAWordResponse['errors']) ? $isThereAWordResponse['message']
                    : "You need to provide a phrase to play pangram string game!",
                [], $isThereAWordResponse['errors']);
        } catch (Exception $e) {
            //Here We should log the traces // We can dump the traces in mongodb
            return Helper::ResponseProcessor(true, "Something went wrong!", [], $e->getMessage());
        }
    }
}