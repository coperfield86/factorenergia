<?php

declare(strict_types=1);

namespace Src\Question\Application\Response;


final class QuestionResponse
{
    public function __construct(
        private array  $tags,
        private array  $owner,
        private bool   $isAnswered,
        private int    $viewCount,
        private int    $answerCount,
        private int    $score,
        private int    $lastActivityDate,
        private int    $creationDate,
        private int    $questionId,
        private string $contentLicense,
        private string $link,
        private string $title,
    )
    {
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function getOwner(): array
    {
        return $this->owner;
    }

    public function getisAnswered(): bool
    {
        return $this->isAnswered;
    }

    public function getViewCount(): int
    {
        return $this->viewCount;
    }

    public function getAnswerCount(): int
    {
        return $this->answerCount;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function getLastActivityDate(): int
    {
        return $this->lastActivityDate;
    }

    public function getCreationDate(): int
    {
        return $this->creationDate;
    }

    public function getQuestionId(): int
    {
        return $this->questionId;
    }

    public function getContentLicense(): string
    {
        return $this->contentLicense;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function toArray(): array
    {
        return [
            'tags' => $this->tags,
            'owner' => $this->owner,
            'isAnswered' => $this->isAnswered,
            'viewCount' => $this->viewCount,
            'answerCount' => $this->answerCount,
            'score' => $this->score,
            'lastActivityDate' => $this->lastActivityDate,
            'creationDate' => $this->creationDate,
            'questionId' => $this->questionId,
            'contentLicense' => $this->contentLicense,
            'link' => $this->link,
            'title' => $this->title,
        ];
    }
}
