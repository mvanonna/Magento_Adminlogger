<?php

class Matthijs_Adminlogger_Model_Mysql4_Adminlogger_Collection
	extends Mage_Core_Model_Mysql4_Collection_Abstract

{

	public function _construct()
	{

		//set to get model to which we'll apply data
		//set to get resource model
		$this->_init('matthijs/adminlogger');

	}

}