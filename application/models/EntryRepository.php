<?php

class Postr_Model_EntryRepository
{
    /**
     * @var Zend_Db_Table_Abstract
     */
    protected $_entryTable;

    protected function _populateRowFromEntry(
        Postr_Model_Entry $entry,
        Zend_Db_Table_Row_Abstract $entryRow = null
    )
    {
        if (null === $entryRow) {
            $entryRow = $this->_entryTable->createRow();
        }
        $entryRow->id = $entry->getId();
        $entryRow->title = $entry->getTitle();
        $entryRow->content = $entry->getContent();
        $entryRow->summary = $entry->getSummary();
        $entryRow->updated = $entry->getUpdated()->get(Zend_Date::ISO_8601);
        $entryRow->published = $entry->getPublished()->get(Zend_Date::ISO_8601);
        return $entryRow;
    }

    protected function _createEntryFromRow(Zend_Db_Table_Row_Abstract $entryRow)
    {
        $updated = new Zend_Date($entryRow->updated, Zend_Date::ISO_8601);
        $published = new Zend_Date($entryRow->published, Zend_Date::ISO_8601);
        $entry = new Postr_Model_Entry();
        $entry
            ->setId($entryRow->id)
            ->setTitle($entryRow->title)
            ->setContent($entryRow->content)
            ->setSummary($entryRow->summary)
            ->setUpdated($updated)
            ->setPublished($published)
        ;
        return $entry;
    }

    public function __construct(Zend_Db_Table_Abstract $entryTable = null)
    {
        if (null === $entryTable) {
            $entryTable = new Postr_Model_DbTable_Entry();
        }
        $this->_entryTable = $entryTable;
    }

    /**
     * Index Of Entries
     *
     * @return array
     */
    public function indexOfEntries()
    {
        $dbAdapter = $this->_entryTable->getAdapter();
        $dbAdapter->beginTransaction();
        $entryRowset = $this->_entryTable->fetchAll();
        $entries = array();
        foreach ($entryRowset as $entryRow) {
            $entries[] = $this->_createEntryFromRow($entryRow);
        }
        $dbAdapter->commit();
        return $entries;
    }

    /**
     * Get Entry
     *
     * @param integer $id
     * @return Postr_Model_Entry
     */
    public function getEntry($id)
    {
        $dbAdapter = $this->_entryTable->getAdapter();
        $dbAdapter->beginTransaction();
        $entryRow = $this->_entryTable->find($id)->current();
        $dbAdapter->commit();
        if (null === $entryRow) {
            return null;
        }
        return $this->_createEntryFromRow($entryRow);
    }

    /**
     * Post Entry
     *
     * @param Postr_Model_Entry $entry
     * @return Postr_Model_EntryRepository      Provides a fluent interface
     */
    public function postEntry(Postr_Model_Entry $entry)
    {
        $dbAdapter = $this->_entryTable->getAdapter();
        $dbAdapter->beginTransaction();
        $entryRow = $this->_populateRowFromEntry($entry);
        $entryRow->id = null;
        $entryRow->save();
        $entry->setId($dbAdapter->lastInsertId());
        $dbAdapter->commit();
        return $this;
    }

    /**
     * Put Entry
     *
     * @param Postr_Model_Entry $entry
     * @return Postr_Model_EntryRepository      Provides a fluent interface
     */
    public function putEntry(Postr_Model_Entry $entry)
    {
        $dbAdapter = $this->_entryTable->getAdapter();
        $dbAdapter->beginTransaction();
        $entryRow = $this->_entryTable->find($entry->getId())->current();
        if (null === $entryRow) {
            //TODO: Throw more specific exception
            throw new Exception('Entry row must already exist.');
        }
        $this->_populateRowFromEntry($entry, $entryRow);
        $entryRow->save();
        $dbAdapter->commit();
        return $this;
    }

    public function deleteEntry(Postr_Model_Entry $entry)
    {
        $dbAdapter = $this->_entryTable->getAdapter();
        $dbAdapter->beginTransaction();
        $entryRow = $this->_entryTable->find($entry->getId())->current();
        $entryRow->delete();
        $dbAdapter->commit();
        return $this;
    }
}
