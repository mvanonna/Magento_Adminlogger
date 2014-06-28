<?php

class Matthijs_Adminlogger_Model_Mysql4_Adminlogger extends Mage_Core_Model_Mysql4_Abstract
{

	//tell the resource model which tabel & PK to use
	protected function _construct()
	{

		$this->_init('matthijs/adminlogger', 'entity_id');

	}
}