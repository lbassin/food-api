<?php

declare(strict_types=1);

namespace App\Infrastructure\Subscribers;

use App\Domain\Exception\ExceptionTypes;
use Doctrine\DBAL\DBALException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{
    private $applicationEnvName;

    public function __construct(string $applicationEnvName)
    {
        $this->applicationEnvName = $applicationEnvName;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => ['onKernelException', 0],
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getException();

        $responseCode = $this->getResponseCode($exception);

        $devData = $this->getDevData($exception);
        $overrideSensitiveData = $this->overrideSensitiveData($exception);

        $response = new JsonResponse (
            array_merge(
                ['message' => $exception->getMessage()],
                $devData,
                $overrideSensitiveData
            ),
            $responseCode
        );

        $event->setResponse($response);
    }

    private function getResponseCode(\Throwable $exception): int
    {
        if ($exception instanceof NotFoundHttpException) {
            return Response::HTTP_NOT_FOUND;
        }

        $mapping = [
            ExceptionTypes::NOT_FOUND => Response::HTTP_NOT_FOUND,
            ExceptionTypes::DATA_PROVIDED_ERROR => Response::HTTP_BAD_REQUEST,
        ];

        if (isset($mapping[$exception->getCode()])) {
            $responseCode = $mapping[$exception->getCode()];
        }

        return $responseCode ?? Response::HTTP_INTERNAL_SERVER_ERROR;
    }

    private function overrideSensitiveData(\Throwable $exception)
    {
        if ($this->isDevModeEnabled()) {
            return [];
        }

        if ($exception instanceof DBALException) {
            return ['message' => 'SQL Error'];
        }

        return [];
    }

    private function getDevData(\Throwable $exception): array
    {
        if (!$this->isDevModeEnabled()) {
            return [];
        }

        return [
            'exception' => get_class($exception),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'code' => $exception->getCode(),
            'previous' => empty($exception->getPrevious()) ? null : [
                'message' => $exception->getPrevious()->getMessage(),
                'exception' => get_class($exception->getPrevious()),
                'file' => $exception->getPrevious()->getFile(),
                'line' => $exception->getPrevious()->getLine(),
                'code' => $exception->getPrevious()->getCode(),
            ],
        ];
    }

    private function isDevModeEnabled(): bool
    {
        return $this->applicationEnvName === 'dev';
    }
}
