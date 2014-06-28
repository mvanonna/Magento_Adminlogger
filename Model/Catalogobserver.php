<?php

class Matthijs_Adminlogger_Model_Catalogobserver
{
	// each function observers a catalog action

	public function categoryMove(Varien_Event_Observer $observer)
	{
		$catOrigData		= $observer->getEvent()->getData('category')->getOrigData();
		$catNewData			= $observer->getEvent()->getData('category')->getData();

		$logArray 			= array();

		$logArray['action'] = 'CategoryMove';
		$logArray['user']	= Mage::getSingleton('admin/session')->getUser()->getUsername();
		$logArray['object']	= $catNewData['name'];
		
		$origPos			= $catOrigData['position'];
		$newPos				= $catNewData['position'];

		if(isset($logArray['object']) && $origPost != $newPos) {
			$logArray['change'] = 	'Category <b>' . $logArray['object'] . '</b> was moved from position ' 
								. $origPos . ' to position ' . $newPos;
		}

		$oldPath = $catOrigData['path'];
		$newPath = $catNewData['path'];

		if(isset($logArray['object']) && $oldPath != $newPath) {
			$logArray['change'] .= 	'<br>' . 'Category Path was changed from ' . $oldPath . ' to ' . $newPath;

		}

		$log = Mage::getModel('matthijs/adminlogger');

		$log->saveLog($logArray);

		// this deletes logs that are older than a given time period.

		$log->deleteOldLogs();
							
	}


	public function categoryDelete(Varien_Event_Observer $observer)

	{

		$category 			= $observer->getEvent()->getData('category');
		$categoryName 		= $category->getData('name');
		$categoryParentId 	= $category->getData('parent_id');
		$categoryModel 		= Mage::getModel('catalog/category');
		$parentName			= $categoryModel->load($categoryParentId)->getName();

		$logArray['action']	= 'CategoryDelete';
		$logArray['user']	= Mage::getSingleton('admin/session')->getUser()->getUsername();
		

		if (isset($categoryName)){
			$logArray['change'] = 'Category ' . $categoryName . ' with parent ' . $parentName . ' was deleted';
			$logArray['object'] = $categoryName;
		}

		$log = Mage::getModel('matthijs/adminlogger');

		$log->saveLog($logArray);
		
		// this deletes logs that are older than a given time period.

		$log->deleteOldLogs();

	}

	public function catalogCategoryPrepareSave(Varien_Event_Observer $observer)
	{	
		
		
		$category 			= $observer->getEvent()->getData('category');
		$categoryName 		= $category->getData('name');
		
		$logArray['action']	= 'CategoryAdd';
		$logArray['user']	= Mage::getSingleton('admin/session')->getUser()->getUsername();
		

		if (isset($categoryName)){
			$logArray['change'] = 'Category ' . $categoryName . ' was created';
			$logArray['object'] = $categoryName;
		}

		$log = Mage::getModel('matthijs/adminlogger');

		$log->saveLog($logArray);
		
		// this deletes logs that are older than a given time period.

		$log->deleteOldLogs();

	}

	public function catalogProductPrepareSave(Varien_Event_Observer $observer)
	{

		$product 			= $observer->getEvent()->getData('product');
		$productName 		= $product->getData('name');

		$logArray['action']	= 'ProductAdd';
		$logArray['user']	= Mage::getSingleton('admin/session')->getUser()->getUsername();
		

		if(isset($productName)){
			$logArray['change']		= 	'Product ' . $productName . 'was created';
			$logArray['object']		= $productName;
		}

		$log = Mage::getModel('matthijs/adminlogger');

		$log->saveLog($logArray);
		
		// this deletes logs that are older than a given time period.

		$log->deleteOldLogs();

	}

	public function catalogControllerProductDelete(Varien_Event_Observer $observer)
	{	

		$product 			= $observer->getEvent()->getData('product');
		$productName 		= $product->getData('name');

		$logArray['action']	= 'ProductDelete';
		$logArray['user']	= Mage::getSingleton('admin/session')->getUser()->getUsername();

		if(isset($productName)){
			$logArray['change']		= 'Product ' . $productName . ' was deleted';
			$logArray['object']		= $productName;
		}

		$log = Mage::getModel('matthijs/adminlogger');

		$log->saveLog($logArray);
		
		// this deletes logs that are older than a given time period.
		
		$log->deleteOldLogs();

	}

}
