<?php

namespace Massfice\ActionManager;

use Massfice\Action\ActionFactory;
use Massfice\Action\HtmlActionFactory;

class HtmlManager extends ActionManager {
    protected function getActionFactory(string $namespace) : ActionFactory {
        return new HtmlActionFactory($namespace);
    }
}

?>