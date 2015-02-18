<?php
namespace xPurchase;
class Model_PurchaseOrder extends \Model_Table{
	public $table="xpurchase_purchase_orders";
	function init(){
		parent::init();

 		$this->hasOne('Epan','epan_id');
		$this->addCondition('epan_id',$this->api->current_website->id);

		$this->hasOne('xHR/Employee','created_by_id')->defaultValue($this->api->current_employee->id)->system(true);
		$f = $this->hasOne('xPurchase/Supplier','supplier_id');
		// $this->hasOne('xShop/PaymentGateway','paymentgateway_id');
		$f->icon = "fa fa-user~red";
		$f = $this->addField('name')->caption('Order ID')->mandatory(true);
		// Order status
			// placed, partial-shipped, shipped, partial-dilivered, dilivered, partial-returned, returned, canceled, complete
		// order payment status
			// unpaid, paid, refunded
		$this->addField('order_from')->enum(array('online','offline'))->defaultValue('offline');
		$f = $this->addField('status')
									->enum(
										array('draft','submitted',
											  'approved','processing',
											  'processed','shipping',
											  'complete','cancel',
											  'return'))->group('a~2');
		$f = $this->addField('on_date')->type('date')->defaultValue(date('Y-m-d'))->group('a~2');
		$f->icon ="fa fa-calendar~blue";

		$f = $this->addField('amount')->mandatory(true)->group('b~3~<i class="fa fa-money"></i> Order Amount');
		$f = $this->addField('net_amount')->mandatory(true)->group('b~3');

		$f = $this->addField('billing_address')->mandatory(true)->group('x~6~<i class="fa fa-map-marker"> Address</i>');
		$f = $this->addField('shipping_address')->mandatory(true)->group('x~6');	
		$f = $this->addField('order_summary')->type('text')->group('y~12');

		$this->addHook('beforeSave',$this);
		$this->addHook('beforeDelete',$this);
		$this->hasMany('xPurchase/PurchaseOrderDetail','purchase_order_id');
		$this->add('dynamic_model/Controller_AutoCreator');
	}

	function beforeSave($m){
	}

	function beforeDelete($m){
		$ord_detail_count = $m->ref('xPurchase/PurchaseOrderDetail')->count()->getOne();
		
		if($ord_detail_count){
			$this->api->js(true)->univ()->errorMessage('Cannot Delete,first delete Order Details')->execute();	
		}
	}
}