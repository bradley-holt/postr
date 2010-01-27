<?php

class Postr_Model_EntryMapperTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Postr_Model_Entry
     */
    private $_testEntry;

    /**
     * @var Postr_Model_EntryMapper
     */
    private $_entryMapper;

    public function setUp()
    {
        include APPLICATION_PATH . '/../scripts/load.sqlite.php';
        $now = new Zend_Date();
        $this->_testEntry = new Postr_Model_Entry();
        $this->_testEntry
            ->setTitle('Test Entry')
            ->setContent('Test entry with' . PHP_EOL . 'multiple lines.')
            ->setSummary('Test entry summary.')
            ->setUpdated($now)
            ->setPublished($now)
        ;
        $this->_entryMapper = new Postr_Model_EntryMapper();
        parent::setUp();
    }

    public function tearDown()
    {
        Zend_Db_Table::getDefaultAdapter()->closeConnection();
        parent::tearDown();
    }

    public function testIndexOfEntriesCountIsThreeAfterPostingThreeEntries()
    {
        $this->_entryMapper->postEntry($this->_testEntry);
        $this->_entryMapper->postEntry($this->_testEntry);
        $this->_entryMapper->postEntry($this->_testEntry);
        $entries = $this->_entryMapper->indexOfEntries();
        $this->assertEquals(
            3,
            $entries->getTotalItemCount()
        );
    }

    public function testGetEntryIsEqualToPostedEntry()
    {
        $this->_entryMapper->postEntry($this->_testEntry);
        $this->assertTrue(
            $this->_testEntry->isEqualTo(
                $this->_entryMapper->getEntry($this->_testEntry->getId())
            )
        );
    }

    public function testEntryIdIsGreaterThanZeroAfterEntryIsPosted()
    {
        $this->_entryMapper->postEntry($this->_testEntry);
        $this->assertGreaterThan(
            0,
            $this->_testEntry->getId()
        );
        return $this->_testEntry->getId();
    }

    public function testGetEntryIsEqualToPutEntry()
    {
        $this->_entryMapper->postEntry($this->_testEntry);
        $now = new Zend_Date();
        $now->addMonth(1);
        $entry = $this->_entryMapper->getEntry($this->_testEntry->getId());
        $entry
            ->setTitle('Updated Test Entry')
            ->setContent('Updated Test entry with' . PHP_EOL . 'multiple lines.')
            ->setSummary('Updated Test entry summary.')
            ->setUpdated($now)
        ;
        $this->_entryMapper->putEntry($entry);
        $this->assertTrue(
            $entry->isEqualTo(
                $this->_entryMapper->getEntry($entry->getId())
            )
        );
    }

    /**
     * @expectedException Exception
     */
    public function testPuttingNonExistentEntryThrowsException()
    {
        $this->_testEntry->setId(42);
        $this->_entryMapper->putEntry($this->_testEntry);
    }

    public function testDeletedEntryIsNull()
    {
        $this->_entryMapper->postEntry($this->_testEntry);
        $entry = $this->_entryMapper->getEntry($this->_testEntry->getId());
        $this->_entryMapper->deleteEntry($entry);
        $deletedEntry = $this->_entryMapper->getEntry($entry->getId());
        $this->assertNull($deletedEntry);
    }
}
