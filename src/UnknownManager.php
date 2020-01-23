<?php

namespace Massfice\ActionManager;

use Massfice\Action\ActionFactory;
use Massfice\Action\HtmlActionFactory;
use Massfice\Action\JsonAction;
use Massfice\ActionExecutor\ActionExecutor;
use Massfice\ActionExecutor\HtmlExecutor;

class UnknownManager extends ActionManager {
    protected function getActionFactory(string $namespace) : ActionFactory {
        return new class($namespace) extends HtmlActionFactory {
            public function create(string $name) : JsonAction {
                return new BadRequest();
            }
        };
    }

    public function createExecutor() : ActionExecutor {
        return new HtmlExecutor($this->data);
    }
}

?>