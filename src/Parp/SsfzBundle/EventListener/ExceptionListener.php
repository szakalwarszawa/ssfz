<?php

namespace Parp\SsfzBundle\EventListener;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Parp\SsfzBundle\Exception\PublicVisibleExcpetion;
use Parp\SsfzBundle\Service\KomunikatyService;

/**
 * Przechwytuje komunikatów o błędzie obsługiwanych wyjątkami.
 */
class ExceptionListener implements EventSubscriberInterface
{
    /**
     * @var KernelInterface
     */
    protected $kernel;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @var Router $router
     */
    protected $router;

    /**
     * @var KomunikatyService
     */
    protected $komunikatyService;

    /**
     * Konstruktor.
     *
     * @param KernelInterface $kernel
     * @param RequestStack $requestStack
     * @param Router $router
     * @param KomunikatyService $komunikatyService
     */
    public function __construct(
        KernelInterface $kernel,
        RequestStack $requestStack,
        Router $router,
        KomunikatyService $komunikatyService
    ) {
        $this->kernel = $kernel;
        $this->requestStack = $requestStack;
        $this->router = $router;
        $this->komunikatyService = $komunikatyService;
    }

    /**
     * @see EventSubscriberInterface
     *
     * @return string[] Tablica nazw nasłuchiwanych zdarzeń.
     */
    public static function getSubscribedEvents()
    {
        $zdarzenia = [
            KernelEvents::EXCEPTION => array('onKernelException', -127),
        ];

        return $zdarzenia;
    }

    /**
     * Uwaga! Wywołanie getKernel() na obiekcie GetResponseForExceptionEvent zwraca
     * obiekt typu HttpKernelInterface, który nie  będzie posiadał informacji o
     * środowisku uruchomieniowym aplikacji. Z tego powodu określanie środowiska
     * zostało przeniesione do konstruktora.
     *
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        switch (get_class($exception)) {
            case PublicVisibleExcpetion::class:
                $komunikat = $exception->getMessage();

                $route = 'beneficjent';
                $this->komunikatyService->bladKomunikat($komunikat);

                $url = $this->router->generate($route);
                $response = new RedirectResponse($url);
                $event->setResponse($response);

                break;
        }
    }
}
