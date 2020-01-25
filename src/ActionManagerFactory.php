<?php

namespace Massfice\ActionManager;

class ActionManagerFactory {
    public static function create(string $name, string $namespace) : ActionManager {
        switch($name) {
            case "html":
                return new HtmlManager($namespace);
            break;
            case "json":
                return new JsonManager($namespace);
            break;
            default:
                return new UnknownManager($namespace);
        }
    }
}

?>