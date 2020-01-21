<?php

namespace Massfice\ActionManager;

use Massfice\Action\ActionFactory;
use Massfice\Action\JsonActionFactory;

class JsonManager extends ActionManager {
    protected function getActionFactory(string $namespace) : ActionFactory {
        return new JsonActionFactory($namespace);
    }
}

?>