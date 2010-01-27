<?php

/**
 * Entry Paginator Adapter
 *
 * @category    Postr
 * @package     Postr_Model
 */
class Postr_Model_EntryPaginatorAdapter extends Zend_Paginator_Adapter_DbTableSelect
{
    /**
     * @var Postr_Model_EntryMapper
     */
    private $_entryMapper;

    /**
     * Construct new Entry Paginator Adapter
     *
     * @param Zend_Db_Select $select
     * @param Postr_Model_EntryMapper $entryMapper
     * @return void
     */
    public function __construct(
        Zend_Db_Select $select,
        Postr_Model_EntryMapper $entryMapper
    )
    {
        parent::__construct($select);
        $this->_entryMapper = $entryMapper;
    }

    /**
     * Returns an array of Entry items for a page.
     *
     * @param  integer $offset Page offset
     * @param  integer $itemCountPerPage Number of items per page
     * @return array
     */
    public function getItems($offset, $itemCountPerPage)
    {
        $entryRowset = parent::getItems($offset, $itemCountPerPage);
        $entries = array ();
        /* @var $entryRow Zend_Db_Table_Row_Abstract */
        foreach ($entryRowset as $entryRow) {
            $entry = $this->_entryMapper->createEntryFromRow($entryRow);
            $entries[] = $entry;
        }
        return $entries;
    }
}
