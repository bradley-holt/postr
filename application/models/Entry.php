<?php

class Postr_Model_Entry
{
    /**
     * @var integer
     */
    private $_id;

    /**
     * @var string
     */
    private $_title;

    /**
     * @var string
     */
    private $_content;

    /**
     * @var string
     */
    private $_summary;

    /**
     * @var Zend_Date
     */
    private $_updated;

    /**
     * @var Zend_Date
     */
    private $_published;

    /**
     * Get ID
     *
     * @return integer
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Set ID
     *
     * @param integer $value
     * @return Postr_Model_Entry    Provides a fluent interface
     */
    public function setId($value)
    {
        $this->_id = (integer) $value;
        return $this;
    }

    /**
     * Get Title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * Set Title
     *
     * @param string $value
     * @return Postr_Model_Entry    Provides a fluent interface
     */
    public function setTitle($value)
    {
        $this->_title = (string) $value;
        return $this;
    }

    /**
     * Get Content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * Set Content
     *
     * @param string $value
     * @return Postr_Model_Entry    Provides a fluent interface
     */
    public function setContent($value)
    {
        $this->_content = (string) $value;
        return $this;
    }

    /**
     * Get Summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->_summary;
    }

    /**
     * Set Summary
     *
     * @param string $value
     * @return Postr_Model_Entry    Provides a fluent interface
     */
    public function setSummary($value)
    {
        $this->_summary = (string) $value;
        return $this;
    }

    /**
     * Get Updated
     * 
     * The updated date object is treated as an immutable value object so a
     * clone of the date object is returned to prevent it from being modified.
     *
     * @return Zend_Date
     */
    public function getUpdated()
    {
        return clone $this->_updated;
    }

    /**
     * Set Updated
     * 
     * The updated date object is treated as an immutable value object so a
     * clone of the date object is assigned to prevent it from being modified.
     *
     * @param Zend_Date $value
     * @return Postr_Model_Entry    Provides a fluent interface
     */
    public function setUpdated(Zend_Date $value)
    {
        $this->_updated = clone $value;
        return $this;
    }

    /**
     * Get Published
     * 
     * The published date object is treated as an immutable value object so a
     * clone of the date object is returned to prevent it from being modified.
     *
     * @return Zend_Date
     */
    public function getPublished()
    {
        return clone $this->_published;
    }

    /**
     * Set Published
     * 
     * The published date object is treated as an immutable value object so a
     * clone of the date object is assigned to prevent it from being modified.
     *
     * @param Zend_Date $value
     * @return Postr_Model_Entry    Provides a fluent interface
     */
    public function setPublished(Zend_Date $value)
    {
        $this->_published = clone $value;
        return $this;
    }
}

