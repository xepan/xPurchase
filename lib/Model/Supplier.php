<?php
namespace xPurchase;
class Model_Supplier extends \Model_Table{
	public $table="xpurchase_suppliers";
	function init(){
		parent::init();

		$this->addField('name');
		$this->addField('moblie_no');
		$this->addField('email_address');
		$this->addField('company');
		$this->addField('website');
		$this->addField('address')->type('text');
		$this->hasMany('xPurchase/PurchaseOrder','supplier_id');
		
		$this->add('Controller_Validator');
		$this->is(array(
							'name|to_trim|required',
							'email_address|to_trim|email|unique',
							)
					);
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}