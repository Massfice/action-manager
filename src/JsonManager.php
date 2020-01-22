<?php

namespace Massfice\ActionManager;

use Massfice\Action\ActionFactory;
use Massfice\Action\JsonActionFactory;
use Massfice\ActionExecutor\ActionExecutor;
use Massfice\ActionExecutor\JsonExecutor;

class JsonManager extends ActionManager {
    protected function getActionFactory(string $namespace) : ActionFactory {
        return new JsonActionFactory($namespace);
    }

    public function createExecutor() : ActionExecutor {
        return new JsonExecutor($this->data);
    }
}

?>