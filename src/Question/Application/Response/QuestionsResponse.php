<?php

declare(strict_types=1);

namespace Src\Question\Application\Response;


final class QuestionsResponse
{
    private array $questionsResponse;

    public function __construct(QuestionResponse ...$questionsResponse)
    {
        $this->questionsResponse = $questionsResponse;
    }

    public function getQuestionsResponse(): array
    {
        return $this->questionsResponse;
    }

    public function toArray(): array
    {
        $questionsResponseArray = [];
        foreach ($this->questionsResponse as $questionResponse) {
        $questionsResponseArray[] = $questionResponse->toArray();
        }
        return $questionsResponseArray;
    }
}
