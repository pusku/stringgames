<?php

namespace App\Tests\Utils;

use App\Utils\Validator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ValidatorTest extends KernelTestCase
{
    /** @test */
    public function palindromeCheckerValidator_function_expected_value_matcher()
    {
        //Setup
        $validator = new Validator();

        //palindromeCheckerValidator
        $palindromeCheckerValidatorTrue = $validator->palindromeCheckerValidator('bark');
        $palindromeCheckerValidatorFalse = $validator->palindromeCheckerValidator('');

        //Do Something

        //Make Assertions
        $this->assertEquals(true, $palindromeCheckerValidatorTrue['success']);
        $this->assertEquals(false, $palindromeCheckerValidatorFalse['success']);
    }

    /** @test */
    public function anagramCheckerValidator_function_expected_value_matcher()
    {
        //Setup
        $validator = new Validator();

        //anagramCheckerValidator
        $anagramCheckerValidatorTrue = $validator->anagramCheckerValidator('coalface', 'cacao elf');
        $anagramCheckerValidatorFalseIfFirstValueIsEmpty = $validator->anagramCheckerValidator('', 'cacao elf');
        $anagramCheckerValidatorFalseIfSecondValueIsEmpty = $validator->anagramCheckerValidator('coalface', '');
        $anagramCheckerValidatorFalseIfBothEmpty = $validator->anagramCheckerValidator('', '');

        //Do Something

        //Make Assertions
        $this->assertEquals(true, $anagramCheckerValidatorTrue['success']);
        $this->assertEquals(false, $anagramCheckerValidatorFalseIfBothEmpty['success']);
        $this->assertEquals(false, $anagramCheckerValidatorFalseIfFirstValueIsEmpty['success']);
        $this->assertEquals(false, $anagramCheckerValidatorFalseIfSecondValueIsEmpty['success']);
    }

    /** @test */
    public function pangramCheckerValidator_function_expected_value_matcher()
    {
        //Setup
        $validator = new Validator();

        //anagramCheckerValidator
        $pangramCheckerValidatorTrue = $validator->pangramCheckerValidator('bark');
        $pangramCheckerValidatorFalse = $validator->pangramCheckerValidator('');

        //Do Something

        //Make Assertions
        $this->assertEquals(true, $pangramCheckerValidatorTrue['success']);
        $this->assertEquals(false, $pangramCheckerValidatorFalse['success']);
    }

}