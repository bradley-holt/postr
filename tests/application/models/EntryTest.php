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

    public function testSetAndGetSummary()
    {
        $value = 'Test entry summary.';
        $this->_entry->setSummary($value);
        $this->assertEquals(
            $value,
            $this->_entry->getSummary()
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

