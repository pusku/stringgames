<?php

namespace App\Tests\UI\Htttp\Rest\Controller\StringGames;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class StringGamesController extends TestCase
{

    /** @test
     * @throws GuzzleException
     */
    public function isPalindrome_function_should_return_expected_values()
    {
        //Setup
        $client = new Client();
        $word = 'anna';
        $checker = $client->request('POST', 'http://localhost:3000/api/palindrome-checker', [
            'body' => json_encode([
                'word' => $word
            ])
        ]);
        $response = json_decode($checker->getBody()->getContents());
        $this->assertEquals(200, $checker->getStatusCode());
        $this->assertEquals(true, $response->success);
        $this->assertEquals($word . " is a palindrome!", $response->message);


        $wrongWord = 'bark';
        $checker = $client->request('POST', 'http://localhost:3000/api/palindrome-checker', [
            'body' => json_encode([
                'word' => $wrongWord
            ])
        ]);
        $response = json_decode($checker->getBody()->getContents());
        $this->assertEquals(200, $checker->getStatusCode());
        $this->assertEquals(true, $response->success);
        $this->assertEquals($wrongWord . " is not a palindrome!", $response->message);

    }

    /** @test
     * @throws GuzzleException
     */
    public function isAnagram_function_should_return_expected_values()
    {
        //Setup
        $client = new Client();
        $word = 'coalface';
        $comparison = 'cacao elf';
        $checker = $client->request('POST', 'http://localhost:3000/api/anagram-checker', [
            'body' => json_encode([
                'word' => $word,
                'comparison' => $comparison
            ])
        ]);
        $response = json_decode($checker->getBody()->getContents());


        $this->assertEquals(200, $checker->getStatusCode());
        $this->assertEquals(true, $response->success);
        $this->assertEquals($word . " is a anagram!", $response->message);

        $wrongWord = 'coalface';
        $wrongComparison = 'dark elf';
        $checker = $client->request('POST', 'http://localhost:3000/api/anagram-checker', [
            'body' => json_encode([
                'word' => $wrongWord,
                'comparison' => $wrongComparison
            ])
        ]);
        $response = json_decode($checker->getBody()->getContents());


        $this->assertEquals(200, $checker->getStatusCode());
        $this->assertEquals(true, $response->success);
        $this->assertEquals($word . " is not a anagram!", $response->message);
    }

    /** @test
     * @throws GuzzleException
     */
    public function isPangram_function_should_return_expected_values()
    {
        //Setup
        $client = new Client();
        $phrase = 'The quick brown fox jumps over the lazy dog';
        $checker = $client->request('POST', 'http://localhost:3000/api/pangram-checker', [
            'body' => json_encode([
                'phrase' => $phrase
            ])
        ]);
        $response = json_decode($checker->getBody()->getContents());


        $this->assertEquals(200, $checker->getStatusCode());
        $this->assertEquals(true, $response->success);
        $this->assertEquals($phrase . " is a pangram!", $response->message);

        $wrongPhrase = 'The British Broadcasting Corporation (BBC) is a British public service broadcaster.';
        $checker = $client->request('POST', 'http://localhost:3000/api/pangram-checker', [
            'body' => json_encode([
                'phrase' => $wrongPhrase
            ])
        ]);
        $response = json_decode($checker->getBody()->getContents());


        $this->assertEquals(200, $checker->getStatusCode());
        $this->assertEquals(true, $response->success);
        $this->assertEquals($wrongPhrase . " is not a pangram!", $response->message);
    }

}