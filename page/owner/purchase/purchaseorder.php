<?php
class page_xPurchase_page_owner_purchase_purchaseorder extends page_xPurchase_page_owner_main{
	function init(){
		parent::init();

		$order_crud=$this->app->layout->add('CRUD');
		$order_crud->setModel('xPurchase/PurchaseOrder');
		$order_crud->addRef('xPurchase/PurchaseOrderDetail',array('label'=>'order details'));
	}
}		