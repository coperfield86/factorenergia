<?php

declare(strict_types=1);

namespace Src\Question\Application\UseCases;

use Src\Question\Application\Request\SearchQuestionsRequest;
use Src\Question\Application\Response\QuestionResponse;
use Src\Question\Application\Response\QuestionsResponse;
use Src\Question\Domain\Repositories\QuestionRepository;
use Src\Shared\Domain\Criteria\Criteria;
use Src\Shared\Domain\Criteria\Order;

final class SearchQuestions
{
    public function __construct(private QuestionRepository $repository)
    {
    }

    public function __invoke(SearchQuestionsRequest $request): QuestionsResponse
    {
        $order = Order::fromValues(null, null);
        return new QuestionsResponse(
            ...$this->map(
                $this->repository->search(
                    new Criteria(
                        $request->filters(),
                        $order,
                        null,
                        null
                    )
                )
            )
        );
    }

    private function map(array $questions): array
    {
        $questionsArray = [];
        foreach ($questions as $question) {
            $questionsArray[] = new QuestionResponse(
                $question->tags,
                (array)$question->owner,
                $question->is_answered,
                $question->view_count,
                $question->answer_count,
                $question->score,
                $question->last_activity_date,
                $question->creation_date,
                $question->question_id,
                $question->content_license,
                $question->link,
                $question->title
            );
        }
        return $questionsArray;
    }
}
