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

    public function setUp()
    {
        include APPLICATION_PATH . '/../scripts/load.sqlite.php';
        $this->bootstrap = APPLICATION_PATH . '/../tests/application/bootstrap.php';
        $now = new Zend_Date();
        $this->_testEntry = new Postr_Model_Entry();
        $this->_testEntry
            ->setTitle('Test Entry')
            ->setContent('Test entry with' . PHP_EOL . 'multiple lines.')
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

    public function testIndexActionContainsCorrectEntryContent()
    {
        $this->_entryRepository->postEntry($this->_testEntry);
        $this->dispatch('/entry');
        $this->assertQueryContentContains(
            '.hfeed .hentry .entry-content',
            $this->_testEntry->getContent()
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

    public function testGetActionContainsCorrectEntrySummary()
    {
        $this->_entryRepository->postEntry($this->_testEntry);
        $this->dispatch('/entry/get/id/' . $this->_testEntry->getId());
        $this->assertQueryContentContains(
            '.hentry .entry-summary',
            $this->_testEntry->getSummary()
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

}

