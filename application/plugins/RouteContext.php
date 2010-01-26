<?php

/**
 * Route Context Plugin
 *
 * @category   Postr
 * @package    Postr_Plugin
 */
class Postr_Plugin_RouteContext extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $view = Zend_Layout::getMvcInstance()->getView();
        $routeContext = array(
            'module-' . $request->getModuleName(),
            'controller-' . $request->getControllerName(), 
            'action-' . $request->getActionName(),
        );
        $view->routeContext = $routeContext;
    }
}
