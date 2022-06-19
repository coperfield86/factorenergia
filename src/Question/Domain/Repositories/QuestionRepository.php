<?php
declare(strict_types=1);

namespace Src\Question\Domain\Repositories;

use Src\Shared\Domain\Criteria\Criteria;

interface QuestionRepository
{
    public function search(Criteria $criteria): array;
}
