<?php namespace TypiCMS\Models;

use TypiCMS\NestedCollection;

class Group extends Base {

	protected $fillable = array(
		'name',
		'permissions',
	);

	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'groups';

	public $view = 'groups';
	public $route = 'groups';


	/**
	 * lists
	 */
	public static $order = 'name';
	public static $direction = 'asc';


}