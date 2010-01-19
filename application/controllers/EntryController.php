<?php

class EntryController extends Zend_Controller_Action
{
    /**
     * @var Postr_Model_EntryRepository
     */
    private $_entryRepository;

    /**
     * Init
     *
     * @return void
     */
    public function init()
    {
        //TODO: Pass this in so that it can be substitued
        $this->_entryRepository = new Postr_Model_EntryRepository();
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
        // action body
    }

    public function putAction()
    {
        // action body
    }

    public function deleteAction()
    {
        // action body
    }


}









