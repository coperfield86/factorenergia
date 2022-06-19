<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Question\Domain\Repositories\QuestionRepository;
use Src\Question\Infrastructure\Guzzle\QuestionGuzzleRepository;

class QuestionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(QuestionRepository::class, QuestionGuzzleRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
