<?php

/**
 * Entry Controller
 *
 */
class EntryController extends Zend_Controller_Action
{
    /**
     * @var Postr_Model_EntryRepository
     */
    private $_entryRepository;

    /**
     * @var Zend_Controller_Router_Interface
     */
    private $_router;

    /**
     * Init
     *
     * @return void
     */
    public function init()
    {
        $this->_helper->redirector->setPrependBase(false);
        //TODO: Pass these in so that it can be substitued
        $this->_entryRepository = new Postr_Model_EntryRepository();
        $this->_router = $this->getFrontController()->getRouter();
        $this->view->headTitle()->prepend('Entry');
    }

    /**
     * Index Action
     *
     * @return void
     */
    public function indexAction()
    {
        $page = $this->_getParam('page', 1);
        $count = $this->_getParam('count', 5);
        $this->view->headTitle()->prepend('Index');
        $entries = $this->_entryRepository->indexOfEntries();
        $entries
            ->setCurrentPageNumber($page)
            ->setItemCountPerPage($count)
        ;
        $this->view->entries = $entries;
    }

    /**
     * New Action
     *
     * @return void
     */
    public function newAction()
    {
        $this->view->headTitle()->prepend('New');
        $entryForm = new Postr_Form_Entry();
        $now = new Zend_Date();
        $entryForm
            ->setMethod('post')
            ->setAction(
                $this->_router->assemble(
                    array(
                        'action'    => 'post',
                    )
                )
            )
            ->populate(
                array(
                    'updated'   => $now->get(Zend_Date::DATETIME_SHORT),
                    'published' => $now->get(Zend_Date::DATETIME_SHORT),
                )
            )
        ;
        $this->view->entryForm = $entryForm;
    }

    /**
     * Get Action
     *
     * @return void
     */
    public function getAction()
    {
        $id = $this->_getParam('id');
        $this->view->headTitle()->prepend('Get');
        $entry = $this->_entryRepository->getEntry($id);
        if (null === $entry) {
            throw new Zend_Controller_Dispatcher_Exception();
        }
        $this->view->entry = $entry;
    }

    /**
     * Edit Action
     *
     * @return void
     */
    public function editAction()
    {
        $id = $this->_getParam('id');
        $this->view->headTitle()->prepend('Edit');
        $entry = $this->_entryRepository->getEntry($id);
        if (null === $entry) {
            throw new Zend_Controller_Dispatcher_Exception();
        }
        $entryForm = new Postr_Form_Entry();
        $now = new Zend_Date();
        $entryForm
            ->setMethod('post')
            ->setAction(
                $this->_router->assemble(
                    array(
                        'action'    => 'put',
                    )
                )
            )
            ->populate(
                array(
                    'title'     => $entry->getTitle(),
                    'content'   => $entry->getContent(),
                    'summary'   => $entry->getSummary(),
                    'updated'   => $now->get(Zend_Date::DATETIME_SHORT),
                    'published' => $entry->getPublished()->get(Zend_Date::DATETIME_SHORT),
                )
            )
        ;
        $this->view->entryForm = $entryForm;
    }

    /**
     * Post Action
     *
     * @return void
     */
    public function postAction()
    {
        $entryForm = new Postr_Form_Entry();
        $this->view->headTitle()->prepend('Post');
        if ($entryForm->isValid($this->_getAllParams())) {
            $title = $entryForm->getValue('title');
            $content = $entryForm->getValue('content');
            $summary = $entryForm->getValue('summary');
            $updated = new Zend_Date($entryForm->getValue('updated'), Zend_Date::DATETIME_SHORT);
            $published = new Zend_Date($entryForm->getValue('published'), Zend_Date::DATETIME_SHORT);
            $entry = new Postr_Model_Entry();
            $entry
                ->setTitle($title)
                ->setContent($content)
                ->setSummary($summary)
                ->setUpdated($updated)
                ->setPublished($published)
            ;
            $this->_entryRepository->postEntry($entry);
            $this->_setParam('id', $entry->getId());
            $this->_redirect(
                $this->_router->assemble(
                    array(
                        'action'    => 'get',
                        'id'        => $entry->getId(),
                    )
                )
            );
        }
        $entryForm
            ->setMethod('post')
            ->setAction(
                $this->_router->assemble(
                    array(
                        'action'    => 'post',
                    )
                )
            )
        ;
        $this->view->entryForm = $entryForm;
    }

    /**
     * Put Action
     *
     * @return void
     */
    public function putAction()
    {
        $id = $this->_getParam('id');
        $this->view->headTitle()->prepend('Put');
        $entry = $this->_entryRepository->getEntry($id);
        if (null === $entry) {
            throw new Zend_Controller_Dispatcher_Exception();
        }
        $entryForm = new Postr_Form_Entry();
        if ($entryForm->isValid($this->_getAllParams())) {
            $title = $entryForm->getValue('title');
            $content = $entryForm->getValue('content');
            $summary = $entryForm->getValue('summary');
            $updated = new Zend_Date($entryForm->getValue('updated'), Zend_Date::DATETIME_SHORT);
            $published = new Zend_Date($entryForm->getValue('published'), Zend_Date::DATETIME_SHORT);
            $entry
                ->setTitle($title)
                ->setContent($content)
                ->setSummary($summary)
                ->setUpdated($updated)
                ->setPublished($published)
            ;
            $this->_entryRepository->putEntry($entry);
            $this->_redirect(
                $this->_router->assemble(
                    array(
                        'action'    => 'get',
                        'id'        => $entry->getId(),
                    )
                )
            );
        }
        $entryForm
            ->setMethod('post')
            ->setAction(
                $this->_router->assemble(
                    array(
                        'action'    => 'put',
                    )
                )
            )
        ;
        $this->view->entryForm = $entryForm;
    }

    /**
     * Delete Action
     *
     * @return void
     */
    public function deleteAction()
    {
        $id = $this->_getParam('id');
        $this->view->headTitle()->prepend('Delete');
        $entry = $this->_entryRepository->getEntry($id);
        if (null === $entry) {
            throw new Zend_Controller_Dispatcher_Exception();
        }
        $this->_entryRepository->deleteEntry($entry);
        $this->_redirect(
            $this->_router->assemble(
                array(
                    'action'    => 'index',
                    'id'        => null,
                )
            )
        );
    }
}
