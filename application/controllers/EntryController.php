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
                    'updated'   => $now->get(Zend_Date::ISO_8601),
                    'published' => $now->get(Zend_Date::ISO_8601),
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
                    'updated'   => $now->get(Zend_Date::ISO_8601),
                    'published' => $entry->getPublished()->get(Zend_Date::ISO_8601),
                )
            )
        ;
        $entryDeleteForm = new Postr_Form_EntryDelete();
        $entryDeleteForm
            ->setMethod('post')
            ->setAction(
                $this->_router->assemble(
                    array(
                        'action'    => 'delete',
                    )
                )
            )
        ;
        $this->view->entry = $entry;
        $this->view->entryForm = $entryForm;
        $this->view->entryDeleteForm = $entryDeleteForm;
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
        $entry = $this->_entryRepository->getEntry($id);
        if (null === $entry) {
            throw new Zend_Controller_Dispatcher_Exception();
        }
        $entryForm = new Postr_Form_Entry();
        if ($entryForm->isValid($this->_getAllParams())) {
            $title = $entryForm->getValue('title');
            $content = $entryForm->getValue('content');
            $summary = $entryForm->getValue('summary');
            $updated = new Zend_Date($entryForm->getValue('updated'), Zend_Date::ISO_8601);
            $published = new Zend_Date($entryForm->getValue('published'), Zend_Date::ISO_8601);
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
