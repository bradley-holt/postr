<?php

/**
 * Entry Form
 *
 * @category    Postr
 * @package     Postr_Form
 */
class Postr_Form_Entry extends Zend_Form
{
    public function init()
    {
        $this->setAttrib('class', 'entry');
        $titleElement = new Zend_Form_Element_Text('title');
        $titleElement
            ->setLabel('Title')
            ->setAttrib('autofocus', '')
            ->setRequired(true)
            ->addValidator('StringLength', false, array(0, 255))
        ;
        $this->addElement($titleElement);
        $contentElement = new Zend_Form_Element_Textarea('content');
        $contentElement
            ->setLabel('Content')
        ;
        $this->addElement($contentElement);
        $summaryElement = new Zend_Form_Element_Textarea('summary');
        $summaryElement
            ->setLabel('Summary')
        ;
        $this->addElement($summaryElement);
        $updatedElement = new Zend_Form_Element_Text('updated');
        $updatedElement
            ->setLabel('Updated')
            ->setRequired(true)
            ->addValidator('Date', false, array(Zend_Date::DATETIME_SHORT))
        ;
        $this->addElement($updatedElement);
        $publishedElement = new Zend_Form_Element_Text('published');
        $publishedElement
            ->setLabel('Published')
            ->addValidator('Date', false, array(Zend_Date::DATETIME_SHORT))
        ;
        $this->addElement($publishedElement);
        $submitElement = new Zend_Form_Element_Submit('submit');
        $submitElement
            ->setLabel('Submit')
            ->setAttrib('class', 'button')
        ;
        $this->addElement($submitElement);
    }
}
