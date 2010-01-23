<?php

class Postr_Form_Entry extends Zend_Form
{
    public function init()
    {
        $titleElement = new Zend_Form_Element_Text('title');
        $titleElement
            ->setLabel('Title')
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
        ;
        $this->addElement($updatedElement);
        $publishedElement = new Zend_Form_Element_Text('published');
        $publishedElement
            ->setLabel('Published')
        ;
        $this->addElement($publishedElement);
        $submitElement = new Zend_Form_Element_Submit('submit');
        $submitElement
            ->setLabel('Submit')
        ;
        $this->addElement($submitElement);
    }
}
