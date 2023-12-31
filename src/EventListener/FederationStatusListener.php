<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FederationStatusListener
{
    public function __construct(private readonly bool $kbinFederationEnabled)
    {
    }

    public function onKernelController(ControllerEvent $event)
    {
        if (!$event->isMainRequest() || $this->kbinFederationEnabled) {
            return;
        }

        $route = $event->getRequest()->attributes->get('_route');

        if (str_starts_with($route, 'ap_')) {
            throw new NotFoundHttpException();
        }
    }
}
