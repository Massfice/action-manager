<?php

namespace Massfice\ActionManager;

use Massfice\Action\ActionFactory;
use Massfice\Action\JsonAction;
use Massfice\ActionExecutor\ActionExecutor;

use Massfice\Action\Standart\NotFound;
use Massfice\Action\Standart\MethodNotAllowed;
use Massfice\Action\Standart\Unauthorized;


abstract class ActionManager {

    protected $factory;
    protected $executor;
    protected $data;

    private function create(string $name) : JsonAction {
        $actionName = $name.$_SERVER["REQUEST_METHOD"];
        $action = $this->factory->create($actionName);

        $subaction = DefaultAction::getInstance()->getDefaultAction();

        if($action instanceof NotFound && $subaction !== null) {
            $action = $subaction;
        }

        if($action instanceof NotFound) {
            $allow = [];
            if($this->factory->check($name."GET")) $allow[] = "GET";
            if($this->factory->check($name."POST")) $allow[] = "POST";
            if($this->factory->check($name."PUT")) $allow[] = "PUT";
            if($this->factory->check($name."DELETE")) $allow[] = "DELETE";
            if($this->factory->check($name."PATCH")) $allow[] = "PATCH";

            if(count($allow) > 0) {
                $action = new MethodNotAllowed($allow);
            }
        }

        return $action;
    }

    private function verify(JsonAction $action) : JsonAction {

        $status = $action->verify();

        while(!$status->getStatus()) {
            $action = $status->getSubstitut();
            if($action === null) {
                $action = new Unauthorized();
            }
            $status = $action->verify();
        }
        
        $this->data = $status->getData();
        return $action;
    }

    public function __construct(string $namespace) {
        $this->factory = $this->getActionFactory($namespace);
        $this->data = [];
    }

    public function createAction($name) : JsonAction {
        $action = $this->create($name);
        $action = $this->verify($action);

        return $action;
    }

    abstract protected function getActionFactory(string $namespace) : ActionFactory;
    abstract public function createExecutor() : ActionExecutor;
}

?>