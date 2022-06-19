<?php

declare(strict_types=1);

namespace Src\Question\Infrastructure\Guzzle;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Src\Question\Domain\Repositories\QuestionRepository;
use Src\Shared\Domain\Criteria\Criteria;

final class QuestionGuzzleRepository implements QuestionRepository
{
    function __construct(private Client $client)
    {
    }

    public function search(Criteria $criteria): array
    {
        $response = $this->client->request('GET', "questions", $this->params($criteria));
        $data = json_decode($response->getBody()->getContents());
        return $data->items;
    }

    private function params(Criteria $criteria): array {
        $params = [
            'query' => [
                'site' => 'stackoverflow'
            ]
        ];

        foreach ($criteria->filters() as $key => $filter) {
            $params['query'][$key] = $filter;
        }

        return $params;
    }
}
