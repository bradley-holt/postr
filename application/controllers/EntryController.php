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
        $entryForm = new Postr_Form_Entry();
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
        $this->view->entries = $entries;
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
        $entry = $this->_entryRepository->getEntry($id);
        $this->view->entry = $entry;
    }

    /**
     * Post Action
     *
     * @return void
     */
    public function postAction()
    {
        $entryForm = new Postr_Form_Entry();
        if ($entryForm->isValid($this->_getAllParams())) {
            $title = $entryForm->getValue('title');
            $content = $entryForm->getValue('content');
            $summary = $entryForm->getValue('summary');
            $updated = new Zend_Date($entryForm->getValue('updated'), Zend_Date::ISO_8601);
            $published = new Zend_Date($entryForm->getValue('published'), Zend_Date::ISO_8601);
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
    }

    /**
     * Put Action
     *
     * @return void
     */
    public function putAction()
    {
        $id = $this->_getParam('id');
        $entryForm = new Postr_Form_Entry();
        if ($entryForm->isValid($this->_getAllParams())) {
            $title = $entryForm->getValue('title');
            $content = $entryForm->getValue('content');
            $summary = $entryForm->getValue('summary');
            $updated = new Zend_Date($entryForm->getValue('updated'), Zend_Date::ISO_8601);
            $published = new Zend_Date($entryForm->getValue('published'), Zend_Date::ISO_8601);
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
    }

    /**
     * Delete Action
     *
     * @return void
     */
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
