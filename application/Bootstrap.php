<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initViewHeadTitle()
    {
        $this->bootstrap('view');
        /* @var $view Zend_View_Abstract */
        $view = $this->getResource('view');
        $view->headTitle()->setSeparator(' :: ');
        $view->headTitle()->prepend('Postr');
    }

    protected function _initPagination()
    {
        Zend_View_Helper_PaginationControl::setDefaultViewPartial(
            'paginator.phtml'
        );
    }
}
