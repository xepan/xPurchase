<?php
class page_xPurchase_page_owner_purchase_supplier extends page_xPurchase_page_owner_main{
	function init(){
		parent::init();

		$crud=$this->app->layout->add('CRUD');
		$crud->setModel('xPurchase/Supplier');
		
	}
}