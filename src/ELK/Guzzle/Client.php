<?php

namespace Yodawy\Observability\ELK\Guzzle;

use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHTTP\Client as Guzzle;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

use AG\ElasticApmLaravel\Facades\ApmAgent;

class Client extends Guzzle{

    protected $stack;
    protected $http;

    public function __construct()
    {
        $this->stack = HandlerStack::create();
        
        parent::__construct(['handler' => $this->stack]);
        
        $this->stack->push(Middleware::mapRequest($this->__mapRequest()));
        // $this->stack->push(Middleware::mapResponse($this->__mapResponse));
    }

    private function __mapRequest() {
        return function(RequestInterface $request) {
            return ApmAgent::addTraceParentHeader($request);
        };
    }

    // private function __mapResponse(ResponseInterface $response) {
    //     return $response;
    // }

}