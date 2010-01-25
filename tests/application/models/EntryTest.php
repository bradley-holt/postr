<?php

class Postr_Model_EntryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Postr_Model_Entry
     */
    private $_entry;

    public function setUp()
    {
        $this->_entry = new Postr_Model_Entry();
    }

    public function tearDown()
    {
        /* Tear Down Routine */
    }

    public function testEntryIsIdenticalToEntryWithSameId()
    {
        $this->_entry->setId(42);
        $entryWithSameId = new Postr_Model_Entry(42);
        $this->assertTrue(
            $this->_entry->isIdenticalTo($entryWithSameId)
        );
    }

    public function testEntryIsEqualToEntryWithSamePropertiesAndDifferentId()
    {
        $now = new Zend_Date();
        $this->_entry
            ->setTitle('Test Entry')
            ->setContent('Test Content')
            ->setSummary('Test Summary')
            ->setUpdated($now)
            ->setPublished($now)
        ;
        $entryWithDifferentId = clone $this->_entry;
        $this->assertTrue(
            $this->_entry->isEqualTo($entryWithDifferentId)
        );
    }

    public function testSetAndGetId()
    {
        $value = 371;
        $this->_entry->setId($value);
        $this->assertEquals(
            $value,
            $this->_entry->getId()
        );
    }

    public function testSetAndGetTitle()
    {
        $value = 'Test Entry';
        $this->_entry->setTitle($value);
        $this->assertEquals(
            $value,
            $this->_entry->getTitle()
        );
    }

    public function testSetAndGetContent()
    {
        $value = 'Test entry with' . PHP_EOL . 'multiple lines.';
        $this->_entry->setContent($value);
        $this->assertEquals(
            $value,
            $this->_entry->getContent()
        );
    }

    public function testGetEmptyContentAsHtml()
    {
        $this->assertEquals(
            '',
            $this->_entry->getContent(true)
        );
    }

    public function testSetAndGetSummary()
    {
        $value = 'Test entry summary.';
        $this->_entry->setSummary($value);
        $this->assertEquals(
            $value,
            $this->_entry->getSummary()
        );
    }

    public function testGetEmptySummaryAsHtml()
    {
        $this->assertEquals(
            '',
            $this->_entry->getSummary(true)
        );
    }

    public function testSetAndGetUpdated()
    {
        $value = new Zend_Date();
        $this->_entry->setUpdated($value);
        $this->assertEquals(
            $value,
            $this->_entry->getUpdated()
        );
    }

    public function testSetAndGetPublished()
    {
        $value = new Zend_Date();
        $this->_entry->setPublished($value);
        $this->assertEquals(
            $value,
            $this->_entry->getPublished()
        );
    }
}
