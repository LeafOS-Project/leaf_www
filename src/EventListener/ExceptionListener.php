<?php

namespace App\EventListener;

use App\Exception\DeviceNotFoundException;
use App\Exception\WikiPageNotFoundException;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Twig\Environment;

#[AsEventListener(event: 'kernel.exception', method: 'onKernelException')]
final class ExceptionListener {

    public function __construct(
        private Environment $twig
    ) {
    }

    public function onKernelException(ExceptionEvent $event) {
        $throwable = $event->getThrowable();
        $throwableClass = get_class($throwable);

        switch ($throwableClass) {
            case DeviceNotFoundException::class:
                $html = $this->twig->render('errors/404.html.twig', [
                    'subject' => 'device',
                    'message' => $throwable->getMessage()
                ]);
                $response = new Response();
                $response->setContent($html);

                $event->setResponse($response);
                break;
            case WikiPageNotFoundException::class:
                $html = $this->twig->render('errors/404.html.twig', [
                    'subject' => 'page',
                    'message' => $throwable->getMessage()
                ]);
                $response = new Response();
                $response->setContent($html);

                $event->setResponse($response);
                break;
            default:
                $html = $this->twig->render('errors/500.html.twig', [
                    'subject' => 'page',
                    'message' => "Our server misbehaved. Bad Server, boo."
                ]);
                $response = new Response();
                $response->setContent($html);

                $event->setResponse($response);
        }
    }
}
