<?php

namespace xPurchase;
class Model_PurchaseOrderDetail extends \Model_Table{
	public $table="xpurchase_purchase_order_details";
	function init(){
		parent::init();
		$this->hasOne('Epan','epan_id');
		$this->addCondition('epan_id',$this->api->current_website->id);
		$this->hasOne('xPurchase/PurchaseOrder','purchase_order_id');
		$this->hasOne('xShop/Item','item_id')->display(array('form'=>'autocomplete/Basic'));

		$this->addField('qty')->type('money');
		$this->addField('unit')->type('money');
		$this->addField('rate')->type('money');
		$this->addField('amount')->type('money');
		// $this->addField('custom_fields')->type('text')->system(false);


		$this->add('dynamic_model/Controller_AutoCreator');
	}
}