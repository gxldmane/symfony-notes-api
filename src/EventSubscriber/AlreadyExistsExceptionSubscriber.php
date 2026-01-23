<?php

namespace App\EventSubscriber;

use App\Exception\AlreadyExistsException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class AlreadyExistsExceptionSubscriber implements EventSubscriberInterface
{

    public function onException(ExceptionEvent $event): void
    {
        $e = $event->getThrowable();

        if ($e instanceof AlreadyExistsException) {
            $event->setResponse(new JsonResponse([
                'message' => $e->getMessage(),
                'Entity' => $e->getEntity(),
            ], 409));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ExceptionEvent::class => 'onException',
        ];
    }
}
