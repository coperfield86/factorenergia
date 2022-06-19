<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\SearchQuestionsLaravelRequest;
use Src\Question\Application\Request\SearchQuestionsRequest;
use Src\Question\Application\UseCases\SearchQuestions;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class QuestionsController extends Controller
{
    public function __construct(private SearchQuestions $searchQuestions)
    {
    }

    public function show(SearchQuestionsLaravelRequest $request): JsonResponse
    {
        $request = new SearchQuestionsRequest($request->all());
        $response = ($this->searchQuestions)($request);
        return $this->successResponse(
            $response->toArray(),
            Response::HTTP_OK
        );
    }
}
