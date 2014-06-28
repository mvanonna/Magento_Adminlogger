<?php

class Matthijs_Adminlogger_Model_Cmsobserver
{

	public function cmsPagePrepareSave(Varien_Event_Observer $observer) 
	{

		
		$page 			= $observer->getEvent()->getData('page');
		$pageName 		= $page->getData('title');
		$identifier 	= $page->getData('identifier');

		$logArray['action']	= 'CmsPageAdd';
		$logArray['user']	= Mage::getSingleton('admin/session')->getUser()->getUsername();

		if(isset($pageName)){
			$logArray['change']		= 'Cms page ' . $pageName . ' was created'
									  . ' with identifier ' . $identifier;
			$logArray['object']		= $pageName;
		}

		$log = Mage::getModel('matthijs/adminlogger');

		$log->saveLog($logArray);
		
		$log->deleteOldLogs();

	}

	public function cmsPageOnDelete(Varien_Event_Observer $observer)
	{	
		
		$pagetitle 		= $observer->getData('title');
		
		$logArray['action']	= 'CmsPageDelete';
		$logArray['user']	= Mage::getSingleton('admin/session')->getUser()->getUsername();

		if(isset($pagetitle)){
			$logArray['change']		= 'Cms page ' . $pagetitle . ' was deleted';
			$logArray['object']		= $pagetitle;
		}

		$log = Mage::getModel('matthijs/adminlogger');

		$log->saveLog($logArray);
		
		$log->deleteOldLogs();

	}

}