<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\Response;

class RootAction
{
    public function handle(): Response
    {
        return new Response('It works');
    }
}
