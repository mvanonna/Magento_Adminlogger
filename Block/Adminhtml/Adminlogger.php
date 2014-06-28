<?php

class Matthijs_Adminlogger_Block_Adminhtml_Adminlogger extends Mage_Adminhtml_Block_Widget_Grid_Container
{	
	
 
    public function __construct()
    {	
    
        $this->_blockGroup = 'matthijs';
        $this->_controller = 'adminhtml_adminlogger';
        $this->_headerText = Mage::helper('matthijs')->__('Log Entries');

        parent::__construct();
    
    }

}

	

