<?php

namespace Massfice\ActionManager;

use Massfice\Action\JsonAction;

class DefaultAction {
    private static $instance;

    private $action;

    private function __construct() {
        $action = null;
    }

    public function getInstance() : self {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function setDefaultAction(JsonAction $action) {
        $this->action = $action;
    }

    public function getDefaultAction() : ?JsonAction {
        return $this->action;
    }
}

?>