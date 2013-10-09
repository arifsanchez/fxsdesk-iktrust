<?php
App::uses('AppModel', 'Model');
/**
 * VaultRequest Model
 *
 * @property Vault $Vault
 */
class VaultRequest extends AppModel {

/**
 * Display field
 *
 * @var string
 */	
	public $primaryKey = 'id';
	public $displayField = 'id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Vault' => array(
			'className' => 'Vault',
			'foreignKey' => 'vault_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasMany = array(
		'VaultChannel' => array(
			'className' => 'VaultChannel',
			'foreignKey' => 'vault_channel_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
