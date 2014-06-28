 <?php
 
class Matthijs_Adminlogger_Block_Adminhtml_Adminlogger_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('matthijs_adminlogger_adminlogger_grid');
        $this->setDefaultSort('timestamp');
        $this->setDefaultDir('desc');
        $this->setSaveParametersInSession(true);
    }
 
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('matthijs/adminlogger')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
 
    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', array(
            'header'    => Mage::helper('matthijs')->__('ID'),
            'index'     => 'entity_id',
        ));
 
        $this->addColumn('action_info', array(
            'header'    => Mage::helper('matthijs')->__('Action'),
            'index'     => 'action_info',
            'type'      => 'options',
            'options' => array( '1'=>'CategoryMove',
                                '2'=>'CategoryDelete',
                                '3' => 'ProductAdd',
                                '4' => 'ProductDelete',
                                '5' => 'CmsPageAdd',
                                '6' => 'CmsPageDelete',
                                '7' => 'CategoryAdd')
        ));
 
        $this->addColumn('object_info', array(
            'header'    => Mage::helper('matthijs')->__('Object'),
            'index'     => 'object_info',
        ));
 
        $this->addColumn('change_info', array(
            'header'    => Mage::helper('matthijs')->__('Change'),
            'index'     => 'change_info',
            'type'      => 'varchar'
        ));

        $this->addColumn('admin_user', array(
            'header'    => Mage::helper('matthijs')->__('Admin'),
            'index'     => 'admin_user',
        ));

        $this->addColumn('timestamp', array(
            'header'    => Mage::helper('matthijs')->__('Timestamp'),
            'index'     => 'timestamp',
        ));
 
        return parent::_prepareColumns();
    }
 
    
}
