<?php

namespace Massfice\ActionManager;

use Massfice\Action\ActionFactory;
use Massfice\Action\HtmlActionFactory;
use Massfice\ActionExecutor\ActionExecutor;
use Massfice\ActionExecutor\HtmlExecutor;

class HtmlManager extends ActionManager {
    protected function getActionFactory(string $namespace) : ActionFactory {
        return new HtmlActionFactory($namespace);
    }

    public function createExecutor() : ActionExecutor {
        return new HtmlExecutor($this->data);
    }
}

?>