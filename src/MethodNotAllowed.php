<?php

namespace Massfice\ActionManager;

use Massfice\Action\HtmlAction;
use Massfice\Action\VerifyStatus;
use Massfice\ResponseStatus\ResponseStatusFactory;
use Massfice\ResponseStatus\ResponseStatus;

class MethodNotAllowed implements HtmlAction {

    private $allow;

    public function __construct(array $allow) {
        $this->allow = $allow;
    }

    public function verify() : VerifyStatus {
        return new VerifyStatus();
    }

    public function load(array $data, array $config) : array {
        return [];
    }

    public function validate(array $data) : ResponseStatus {
        $status = ResponseStatusFactory::create(405);
        $status->addError("Method Not Allowed");
        $status->setAllow($this->allow);
        return $status;
    }

    public function execute(array $data) : array {
        return [];
    }

    public function onDisplay(array $data) {

    }

    public function onError(array $errors) {
        
    }
}

?>