<?php
App::uses('AppModel', 'Model');
/**
 * VaultRequest Model
 *
 * @property Vault $Vault
 */
class VaultChannel extends AppModel {

/**
 * Display field
 *
 * @var string
 */	
	public $primaryKey = 'id';
	public $displayField = 'name';

}
