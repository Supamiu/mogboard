<?php

namespace App\EventListener;

use App\Common\User\Users;
use App\Common\Utils\Environment;
use App\Common\Utils\Language;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RequestListener
{
    /** @var Users */
    private $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        /** @var Request $request */
        $request = $event->getRequest();
    
        // if options or LE test, skip
        if ($request->getMethod() == 'OPTIONS' || stripos($request->getUri(), '.well-known') !== false) {
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: *");
            header("HTTP/1.1 200 OK");
            die(200);
        }
        
        if (!$event->isMasterRequest()) {
            return;
        }

        if ($sentry = getenv('SENTRY_KEY')) {
            (new \Raven_Client($sentry))->install();
        }
    
        // register environment
        Environment::register($request);
    
        // register language based on domain
        Language::register($request);

        // set last online
        $this->users->setLastOnline();
        
        // refresh alert expiry dates
        $this->users->refreshUsersAlerts();
    }
}
