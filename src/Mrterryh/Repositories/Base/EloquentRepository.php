<?php

namespace Mrterryh\Repositories\Base;

use Mrterryh\Repositories\Contracts\RepositoryContract;

use Illuminate\Foundation\Application;
use Exception;
use DB;

abstract class EloquentRepository implements RepositoryContract
{
	/**
	 * The Illuminate Application instance.
	 * @var Application
	 */
	protected $app;

	/**
	 * The model instance. This will be set in the getModel() method.
	 * @var null
	 */
	protected $modelInstance = null;

	/**
	 * Class constructor.
	 * @param Application $app The Application instance.
	 */
	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	/**
	 * Returns the model to be used by the repository by attempting to access
	 * the $model property of the subclass.
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getModel()
	{
		// Return the existing model if it has already been resolved.
		if ($this->modelInstance)
			return $this->modelInstance;

		// Otherwise, resolve it, and store it in the repository instance.
		$className = get_parent_class($this);

		if (!isset($this->model))
			throw new Exception("No model was specified for " . $className);

		return $this->modelInstance = $this->app->make($this->model);
	}

	/**
	 * Returns all resources for the table.
	 * @param  array  $select An array containing the names of the columns to select.
	 * @return mixed
	 */
	public function all(array $select = array('*'))
	{
		return $this->getModel()->select($select)->get();
	}

	/**
	 * Returns all resources that match the given criteria.
	 * @param  array  $conditionals A key-value array of conditionals (name => Terry, etc)
	 * @param  array  $select       An array containing the names of the columns to select.
	 * @return mixed
	 */
	public function allWhere(array $conditionals, array $select = array('*'))
	{
		return $this->getModel()->select($select)->where($conditionals)->get();
	}

	/**
	 * Returns all resources, paginated.
	 * @param  integer $perPage The number of resources to display per page.
	 * @param  array   $select  An array containing the names of the columns to select.
	 * @return mixed
	 */
	public function paginate($perPage = 10, array $select = array('*'))
	{
		return $this->getModel()->select($select)->paginate($perPage);
	}

	/**
	 * Returns all resources that match the given criteria, paginated.
	 * @param  array   $conditionals A key-value array of conditionals (name => Terry, etc)
	 * @param  integer $perPage      The number of resources to display per page.
	 * @param  array   $select       An array containing the names of the columns to select.
	 * @return mixed
	 */
	public function paginateWhere(array $conditionals, $perPage = 10, array $select = array('*'))
	{
		return $this->getModel()->select($select)->where($conditionals)->paginate($perPage);
	}

	/**
	 * Creates a new resource with the data provided.
	 * @param  array  $data A key-value array of the data to insert.
	 * @return mixed
	 */
	public function create(array $data)
	{
		return $this->getModel()->create($data);
	}

	/**
	 * Updates the resource with the given ID, with the data provided.
	 * @param  integer $id   The ID of the resource to update.
	 * @param  array   $data A key-value array of the data to replace.
	 * @return mixed
	 */
	public function update($id, array $data)
	{
		$entity = $this->find($id);

		foreach ($data as $key => $value) {
			$entity->$key = $value;
		}

		return $entity->save();
	}

	/**
	 * Deletes the resource with the given ID.
	 * @param  integer $id The ID of the resource to delete.
	 * @return mixed
	 */
	public function delete($id)
	{
		return $this->find($id)->delete();
	}

	/**
	 * Returns the resource with the given ID.
	 * @param  integer $id     The ID of the resource to fetch.
	 * @param  array   $select An array containing the names of the columns to select.
	 * @return mixed
	 */
	public function find($id, array $select = array('*'))
	{
		return $this->getModel()->find($id);
	}

	/**
	 * Returns the single resource that matches the provided criteria.
	 * @param  array  $conditionals A key-value array of conditionals (name => Terry, etc)
	 * @param  array  $select       An array containing the names of the columns to select.
	 * @return mixed
	 */
	public function getWhere(array $conditionals, array $select = array('*'))
	{
		return $this->getModel()->select($select)->where($conditionals)->first();
	}
	
	/**
	 * Deletes all resources.
	 * @return mixed
	 */
	 public function deleteAll()
	 {
	 	return $this->getModel()->truncate();
	 }
	 
	/**
	 * Returns all deleted resources for the table.
	 * @param  array  $select An array containing the names of the columns to select.
	 * @return mixed
	 */
	public function allDeleted(array $select = array('*'))
	{
		return $this->getModel()->withTrashed()->select($select)->get();
	}
}
