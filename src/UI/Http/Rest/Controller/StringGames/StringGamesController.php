<?php

namespace App\UI\Http\Rest\Controller\StringGames;

use App\Utils\Checker;
use App\Utils\Helper;
use App\Utils\Validator;
use PHPUnit\TextUI\Help;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Description of StringGamesController
 *
 * @author Ashiqur <raahmansmail@gmail.com>
 */
class StringGamesController extends AbstractController
{
    private $checker;
    protected static $defaultName = 'app:string-games-controller';

    public function __construct(Checker $checker)
    {
        $this->checker = $checker;
    }

    /**
     * @Route(
     *     "/palindrome-checker",
     *     name="palindrome_checker",
     *     methods={"POST"},
     *     requirements={
     *      "word": "\w+"
     *     }
     * )
     * @OA\Response(
     *     response=200,
     *     description="Palindrome Checked successfully",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(
     *          property="isPalindrome", type="string"
     *        )
     *     )
     * )
     * @OA\Response(
     *     response=400,
     *     description="Bad request"
     * )
     * @OA\RequestBody(
     *     @OA\JsonContent(
     *         type="object",
     *         @OA\Property(property="word", type="string")
     *     )
     * )
     *
     * @OA\Tag(name="Checker")
     */
    public function palindromeCheckerAction(Request $request): JsonResponse
    {
        try {
            $parameters = json_decode($request->getContent(), true);
            $word = $parameters["word"];
            $validationResponse = Validator::palindromeCheckerValidator($word);
            if (!$validationResponse['success'])
                return Helper::returnMessage($validationResponse, Response::HTTP_BAD_REQUEST);

            $response = $this->checker->isPalindrome($word);
            if (!$response) return Helper::returnMessage(Helper::ResponseProcessor(true, $word . ' is not a palindrome!', ['isPalindrome' => false]), Response::HTTP_OK);

            return Helper::returnMessage(Helper::ResponseProcessor(true,
                $word . ' is a palindrome!', ['isPalindrome' => true]), Response::HTTP_OK);

        } catch (Exception $e) {
            return Helper::returnMessage(Helper::ResponseProcessor(
                false, "Something went wrong!", [], $e->getMessage()),
                Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route(
     *     "/anagram-checker",
     *     name="anagram_checker",
     *     methods={"POST"},
     *     requirements={
     *      "word": "\w+",
     *      "comparison": "\w+"
     *     }
     * )
     * @OA\Response(
     *     response=200,
     *     description="Anagram Checked successfully",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(
     *          property="isAnagram", type="string"
     *        )
     *     )
     * )
     * @OA\Response(
     *     response=400,
     *     description="Bad request"
     * )
     * @OA\RequestBody(
     *     @OA\JsonContent(
     *         type="object",
     *         @OA\Property(property="word", type="string"),
     *         @OA\Property(property="comparison", type="string")
     *     )
     * )
     *
     * @OA\Tag(name="Checker")
     */
    public function anagramCheckerAction(Request $request): JsonResponse
    {
        try {
            $parameters = json_decode($request->getContent(), true);
            $word = $parameters["word"];
            $comparison = $parameters["comparison"];
            $validationResponse = Validator::anagramCheckerValidator($word, $comparison);

            if (!$validationResponse['success'])
                return Helper::returnMessage($validationResponse, Response::HTTP_BAD_REQUEST);

            $response = $this->checker->isAnagram($word, $comparison);
            if (!$response) return Helper::returnMessage(Helper::ResponseProcessor(true, $word . ' is not a anagram!', ['isAnagram' => false]), Response::HTTP_OK);

            return Helper::returnMessage(Helper::ResponseProcessor(true,
                $word . ' is a anagram!', ['isAnagram' => true]), Response::HTTP_OK);

        } catch (Exception $e) {
            return Helper::returnMessage(Helper::ResponseProcessor(
                false, "Something went wrong!", [], $e->getMessage()),
                Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route(
     *     "/pangram-checker",
     *     name="pangram_checker",
     *     methods={"POST"},
     *     requirements={
     *      "phrase": "\w+"
     *     }
     * )
     * @OA\Response(
     *     response=200,
     *     description="Pangram Checked successfully",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(
     *          property="isPangram", type="string"
     *        )
     *     )
     * )
     * @OA\Response(
     *     response=400,
     *     description="Bad request"
     * )
     * @OA\RequestBody(
     *     @OA\JsonContent(
     *         type="object",
     *         @OA\Property(property="phrase", type="string")
     *     )
     * )
     *
     * @OA\Tag(name="Checker")
     */
    public function pangramCheckerAction(Request $request): JsonResponse
    {
        try {
            $parameters = json_decode($request->getContent(), true);
            $phrase = $parameters["phrase"];
            $response = $this->checker->isPanGram($phrase);
            if (!$response) return Helper::returnMessage(Helper::ResponseProcessor(true, $phrase . ' is not a pangram!', ['isPangram' => false]), Response::HTTP_OK);

            return Helper::returnMessage(Helper::ResponseProcessor(true,
                $phrase . ' is a pangram!', ['isPangram' => true]), Response::HTTP_OK);
        } catch (Exception $e) {
            return Helper::returnMessage(Helper::ResponseProcessor(
                false, "Something went wrong!", [], $e->getMessage()),
                Response::HTTP_BAD_REQUEST);
        }
    }

}
