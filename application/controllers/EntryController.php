<?php

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
        //TODO: Pass these in so that it can be substitued
        $this->_entryRepository = new Postr_Model_EntryRepository();
        $this->_router = $this->getFrontController()->getRouter();
    }

    /**
     * Index Action
     *
     * @return void
     */
    public function indexAction()
    {
        $entries = $this->_entryRepository->indexOfEntries();
        $this->view->entries = $entries;
    }

    public function getAction()
    {
        $id = $this->_getParam('id');
        $entry = $this->_entryRepository->getEntry($id);
        $this->view->entry = $entry;
    }

    public function postAction()
    {
        $title = $this->_getParam('title');
        $content = $this->_getParam('content');
        $summary = $this->_getParam('summary');
        $updated = new Zend_Date($this->_getParam('updated'), Zend_Date::ISO_8601);
        $published = new Zend_Date($this->_getParam('published'), Zend_Date::ISO_8601);
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

    public function putAction()
    {
        $id = $this->_getParam('id');
        $title = $this->_getParam('title');
        $content = $this->_getParam('content');
        $summary = $this->_getParam('summary');
        $updated = new Zend_Date($this->_getParam('updated'), Zend_Date::ISO_8601);
        $published = new Zend_Date($this->_getParam('published'), Zend_Date::ISO_8601);
        $entry = $this->_entryRepository->getEntry($id);
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

    public function deleteAction()
    {
        $id = $this->_getParam('id');
        $entry = $this->_entryRepository->getEntry($id);
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









