<?php

/**
 * Entry Delete Form
 *
 * @category    Postr
 * @package     Postr_Form
 */
class Postr_Form_EntryDelete extends Zend_Form
{
    public function init()
    {
        $deleteElement = new Zend_Form_Element_Submit('delete');
        $deleteElement
            ->setLabel('Delete')
        ;
        $this->addElement($deleteElement);
    }
}
