<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class LoginAction
{
    private $kernel;

    public function __construct(HttpKernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public function handle(Request $request): Response
    {
        // Fallback to JWT controller is content-type header is missing
        $request->headers->set('content-type', 'application/json');

        return $this->kernel->handle($request);
    }
}
