<?php

namespace App\Tests\Utils;

use App\Utils\Checker;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CheckerTest extends KernelTestCase
{
    /** @test */
    public function isPalindrome_function_should_return_boolean()
    {
        //Setup
        $checker = new Checker();

        //isPalindrome
        $isPalindromeTrue = $checker->isPalindrome('anna');
        $isPalindromeFalse = $checker->isPalindrome('bark');

        //If Empty Should return true
        $isPalindromeShouldNotBeEmpty = $checker->isPalindrome(''); //Should Return true //But in Integration testing it should return false \
        //and a message as it was integrated with a validator

        //Do Something

        //Make Assertions
        $this->assertEquals(true, $isPalindromeTrue);
        $this->assertEquals(false, $isPalindromeFalse);
        $this->assertEquals(true, $isPalindromeShouldNotBeEmpty);
    }


    /** @test */
    public function isAnagram_function_should_return_boolean()
    {
        //Setup
        $checker = new Checker();

        //isAnagram
        $isAnagramTrue = $checker->isAnagram('coalface', 'cacao elf');
        $isAnagramFalse = $checker->isAnagram('coalface', 'dark elf');

        //If Empty Should return true
        $isAnagramShouldNotBeEmpty = $checker->isPalindrome(''); //Should Return true //But in Integration testing it should return false \
        //and a message as it was integrated with a validator

        //Do Something

        //Make Assertions
        $this->assertEquals(true, $isAnagramTrue);
        $this->assertEquals(false, $isAnagramFalse);
        $this->assertEquals(true, $isAnagramShouldNotBeEmpty);
    }

    /** @test */
    public function isPangram_function_should_return_boolean()
    {
        //Setup
        $checker = new Checker();

        //isPangram
        $isPangramTrue = $checker->isPanGram('The quick brown fox jumps over the lazy dog');
        $isPangramFalse = $checker->isPanGram('The British Broadcasting Corporation (BBC) is a British public service broadcaster.');

        //If Empty Should return true
        $isPangramShouldNotBeEmpty = $checker->isPalindrome(''); //Should Return true //But in Integration testing it should return false \
        //and a message as it was integrated with a validator

        //Do Something

        //Make Assertions
        $this->assertEquals(true, $isPangramTrue);
        $this->assertEquals(false, $isPangramFalse);
        $this->assertEquals(true, $isPangramShouldNotBeEmpty);
    }

    /** @test */
    public function isThereAWord_function_should_return_boolean()
    {
        //Setup
        $checker = new Checker();

        //isPangram
        $isThereAWordTrue = $checker->isThereAWord('The quick brown fox jumps over the lazy dog');
        $isThereAWordFalse = $checker->isThereAWord('');

        //Do Something

        //Make Assertions
        $this->assertEquals(true, $isThereAWordTrue['success']);
        $this->assertEquals(false, $isThereAWordFalse['success']);
    }
}