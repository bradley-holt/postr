<?php

class Postr_Form_EntryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Postr_Form_Entry
     */
    private $_entryForm;

    public function setUp()
    {
        $this->_entryForm = new Postr_Form_Entry();
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testTitleIsATextElement()
    {
        $element = $this->_entryForm->getElement('title');
        $this->assertType(
            'Zend_Form_Element_Text',
            $element
        );
    }

    public function testTitleElementHasCorrectLabel()
    {
        $element = $this->_entryForm->getElement('title');
        $this->assertEquals(
            'Title',
            $element->getLabel()
        );
    }

    public function testContentIsATextareaElement()
    {
        $element = $this->_entryForm->getElement('entry_content');
        $this->assertType(
            'Zend_Form_Element_Textarea',
            $element
        );
    }

    public function testContentElementHasCorrectLabel()
    {
        $element = $this->_entryForm->getElement('entry_content');
        $this->assertEquals(
            'Content',
            $element->getLabel()
        );
    }

    public function testSummaryIsATextareaElement()
    {
        $element = $this->_entryForm->getElement('entry_summary');
        $this->assertType(
            'Zend_Form_Element_Textarea',
            $element
        );
    }

    public function testSummaryElementHasCorrectLabel()
    {
        $element = $this->_entryForm->getElement('entry_summary');
        $this->assertEquals(
            'Summary',
            $element->getLabel()
        );
    }

    public function testUpdatedIsATextElement()
    {
        $element = $this->_entryForm->getElement('updated');
        $this->assertType(
            'Zend_Form_Element_Text',
            $element
        );
    }

    public function testUpdatedElementHasCorrectLabel()
    {
        $element = $this->_entryForm->getElement('updated');
        $this->assertEquals(
            'Updated',
            $element->getLabel()
        );
    }

    public function testPublishedIsATextElement()
    {
        $element = $this->_entryForm->getElement('published');
        $this->assertType(
            'Zend_Form_Element_Text',
            $element
        );
    }

    public function testPublishedElementHasCorrectLabel()
    {
        $element = $this->_entryForm->getElement('published');
        $this->assertEquals(
            'Published',
            $element->getLabel()
        );
    }

    public function testSubmitIsASubmitElement()
    {
        $element = $this->_entryForm->getElement('submit');
        $this->assertType(
            'Zend_Form_Element_Submit',
            $element
        );
    }

    public function testSubmitElementHasCorrectLabel()
    {
        $element = $this->_entryForm->getElement('submit');
        $this->assertEquals(
            'Submit',
            $element->getLabel()
        );
    }
}
