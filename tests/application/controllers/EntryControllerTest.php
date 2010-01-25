<?php

class EntryControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{
    /**
     * @var Postr_Model_Entry
     */
    private $_testEntry;

    /**
     * @var Postr_Model_EntryRepository
     */
    private $_entryRepository;

    /**
     * Get Test Entry Params
     *
     * @return array
     */
    private function _getTestEntryParams()
    {
        return array(
            'title'     => $this->_testEntry->getTitle(),
            'content'   => $this->_testEntry->getContent(),
            'summary'   => $this->_testEntry->getSummary(),
            'updated'   => $this->_testEntry->getUpdated()->get(Zend_Date::DATETIME_SHORT),
            'published' => $this->_testEntry->getPublished()->get(Zend_Date::DATETIME_SHORT),
        );
    }

    public function setUp()
    {
        include APPLICATION_PATH . '/../scripts/load.sqlite.php';
        $this->bootstrap = APPLICATION_PATH . '/../tests/application/bootstrap.php';
        $now = new Zend_Date();
        $this->_testEntry = new Postr_Model_Entry();
        $this->_testEntry
            ->setTitle('Test Entry')
            ->setContent('Test entry content.')
            ->setSummary('Test entry summary.')
            ->setUpdated($now)
            ->setPublished($now)
        ;
        $this->_entryRepository = new Postr_Model_EntryRepository();
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testIndexActionContainsThreeEntriesAfterPostingThreeEntries()
    {
        $this->_entryRepository->postEntry($this->_testEntry);
        $this->_entryRepository->postEntry($this->_testEntry);
        $this->_entryRepository->postEntry($this->_testEntry);
        $this->dispatch('/entry');
    	$this->assertQueryCount('.hfeed .hentry', 3);
    }

    public function testIndexActionContainsCorrectEntryTitle()
    {
        $this->_entryRepository->postEntry($this->_testEntry);
        $this->dispatch('/entry');
        $this->assertQueryContentContains(
            '.hfeed .hentry .entry-title',
            $this->_testEntry->getTitle()
        );
    }

    public function testIndexActionContainsCorrectEntrySummary()
    {
        $this->_entryRepository->postEntry($this->_testEntry);
        $this->dispatch('/entry');
        $this->assertQueryContentContains(
            '.hfeed .hentry .entry-summary',
            $this->_testEntry->getSummary()
        );
    }

    public function testIndexActionContainsCorrectEntryUpdated()
    {
        $this->_entryRepository->postEntry($this->_testEntry);
        $this->dispatch('/entry');
        $this->assertQuery(
            '.hfeed .hentry abbr.updated[title="' . $this->_testEntry->getUpdated()->get(Zend_Date::ISO_8601) . '"]'
        );
        $this->assertQueryContentContains(
            '.hfeed .hentry abbr.updated',
            $this->_testEntry->getUpdated()->get(Zend_Date::DATETIME_SHORT)
        );
    }

    public function testIndexActionContainsCorrectEntryPublished()
    {
        $this->_entryRepository->postEntry($this->_testEntry);
        $this->dispatch('/entry');
        $this->assertQuery(
            '.hfeed .hentry abbr.published[title="' . $this->_testEntry->getPublished()->get(Zend_Date::ISO_8601) . '"]'
        );
        $this->assertQueryContentContains(
            '.hfeed .hentry abbr.published',
            $this->_testEntry->getPublished()->get(Zend_Date::DATETIME_SHORT)
        );
    }

    public function testIndexActionContainsEntryForm()
    {
        $this->_entryRepository->postEntry($this->_testEntry);
        $this->dispatch('/entry');
        $this->assertQuery(
            'form.entry[method="post"]'
        );
        $this->assertQuery(
            'form.entry[action="/entry/post"]'
        );
    }

    public function testGetActionContainsCorrectEntryTitle()
    {
        $this->_entryRepository->postEntry($this->_testEntry);
        $this->dispatch('/entry/get/id/' . $this->_testEntry->getId());
        $this->assertQueryContentContains(
            '.hentry .entry-title',
            $this->_testEntry->getTitle()
        );
    }

    public function testGetActionContainsCorrectEntryContent()
    {
        $this->_entryRepository->postEntry($this->_testEntry);
        $this->dispatch('/entry/get/id/' . $this->_testEntry->getId());
        $this->assertQueryContentContains(
            '.hentry .entry-content',
            $this->_testEntry->getContent()
        );
    }

    public function testGetActionContainsCorrectEntryUpdated()
    {
        $this->_entryRepository->postEntry($this->_testEntry);
        $this->dispatch('/entry/get/id/' . $this->_testEntry->getId());
        $this->assertQuery(
            '.hentry abbr.updated[title="' . $this->_testEntry->getUpdated()->get(Zend_Date::ISO_8601) . '"]'
        );
        $this->assertQueryContentContains(
            '.hentry abbr.updated',
            $this->_testEntry->getUpdated()->get(Zend_Date::DATETIME_SHORT)
        );
    }

    public function testGetActionContainsCorrectEntryPublished()
    {
        $this->_entryRepository->postEntry($this->_testEntry);
        $this->dispatch('/entry/get/id/' . $this->_testEntry->getId());
        $this->assertQuery(
            '.hentry abbr.published[title="' . $this->_testEntry->getPublished()->get(Zend_Date::ISO_8601) . '"]'
        );
        $this->assertQueryContentContains(
            '.hentry abbr.published',
            $this->_testEntry->getPublished()->get(Zend_Date::DATETIME_SHORT)
        );
    }

    public function testGetActionContainsEntryForm()
    {
        $this->_entryRepository->postEntry($this->_testEntry);
        $this->dispatch('/entry/get/id/' . $this->_testEntry->getId());
        $this->assertQuery(
            'form.entry[method="post"]'
        );
        $this->assertQuery(
            'form.entry[action="/entry/put/id/' . $this->_testEntry->getId() . '"]'
        );
    }

    public function testGetActionWithNonExistentIdReturns404()
    {
        $this->dispatch('/entry/get/id/100');
        $this->assertResponseCode(404);
    }

    public function testPostActionRedirectsToGetAction()
    {
        $this->getRequest()->setParams(
            $this->_getTestEntryParams()
        );
        $this->dispatch('/entry/post');
        $this->assertRedirectRegex('%/entry/get/id/\b\d+\b%');
    }

    public function testPostActionEntryIsCorrect()
    {
        $this->getRequest()->setParams(
            $this->_getTestEntryParams()
        );
        $this->dispatch('/entry/post');
        $id = $this->getRequest()->getParam('id');
        $postedEntry = $this->_entryRepository->getEntry($id);
        $this->assertTrue(
            $this->_testEntry->isEqualTo(
                $postedEntry
            )
        );
    }

    public function testPutActionRedirectsToGetAction()
    {
        $this->_entryRepository->postEntry($this->_testEntry);
        $this->getRequest()->setParams(
            $this->_getTestEntryParams()
        );
        $this->dispatch('/entry/put/id/' . $this->_testEntry->getId());
        $this->assertRedirectRegex('%/entry/get/id/\b\d+\b%');
    }

    public function testPutActionEntryIsCorrect()
    {
        $this->_entryRepository->postEntry($this->_testEntry);
        $this->getRequest()->setParams(
            $this->_getTestEntryParams()
        );
        $this->dispatch('/entry/put/id/' . $this->_testEntry->getId());
        $id = $this->getRequest()->getParam('id');
        $putEntry = $this->_entryRepository->getEntry($id);
        $this->assertTrue(
            $this->_testEntry->isEqualTo(
                $putEntry
            )
        );
    }

    public function testPutActionWithNonExistentIdReturns404()
    {
        $this->getRequest()->setParams(
            $this->_getTestEntryParams()
        );
        $this->dispatch('/entry/put/id/100');
        $this->assertResponseCode(404);
    }

    public function testDeleteActionRedirectsToIndexAction()
    {
        $this->_entryRepository->postEntry($this->_testEntry);
        $this->dispatch('/entry/delete/id/' . $this->_testEntry->getId());
        $this->assertRedirect('/entry');
    }

    public function testDeleteActionEntryIsDeleted()
    {
        $this->_entryRepository->postEntry($this->_testEntry);
        $this->dispatch('/entry/delete/id/' . $this->_testEntry->getId());
        $id = $this->getRequest()->getParam('id');
        $deletedEntry = $this->_entryRepository->getEntry($id);
        $this->assertNull($deletedEntry);
    }

    public function testDeleteActionWithNonExistentIdReturns404()
    {
        $this->dispatch('/entry/delete/id/100');
        $this->assertResponseCode(404);
    }
}
