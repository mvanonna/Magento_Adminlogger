<?php

class Matthijs_Adminlogger_Model_Adminlogger extends Mage_Core_Model_Abstract
{

	protected function _construct()
	{

		//initialize resource model
		$this->_init('matthijs/adminlogger');

	}

	public function saveLog($logArray)

	{	
		$log = Mage::getModel('matthijs/adminlogger');

		$log->setActionInfo($logArray['action']);

		if (isset($logArray['user'])) {							
			$log->setAdminUser($logArray['user']);
		}

		if (isset($logArray['object'])) {
			$log->setObjectInfo($logArray['object']);
		}

		if (isset($logArray['change'])) {
			$log->setChangeInfo($logArray['change']);
		}

		$datetime = date("Y-m-d H:i:s", Mage::getModel('core/date')->timestamp(time()));

		$log->setTimestamp($datetime);
		
		if(isset($logArray['user']) && isset($logArray['object']) && isset($logArray['change'])){
			try {
			$log->save();
			} catch(Exception $e) {
				throw new Exception ("Log not saved");
			}

		}

	}

	public function deleteOldLogs()

	{
		$log = Mage::getModel('matthijs/adminlogger');

		$date 		= new DateTime('Europe/Berlin');
		$monthBack  = $date->sub(new DateInterval('P1M'));
		$monthBack	= $date->format('Y-m-d H:i:s');

		$oldLogCollection	= 	Mage::getModel('matthijs/adminlogger')->getCollection()
								->addFieldtoFilter('timestamp',
								array('to' => $monthBack));
		
		$oldLogsData 	= $oldLogCollection->getData();
		
		foreach($oldLogsData as $oldLogData) {
			$oldLog = $log->load($oldLogData['entity_id']);

			try {
				$oldLog->delete();
			} catch (Exception $e) {
				throw new Exception ('Can\'t delete old logs');
			}
		}

	}
}