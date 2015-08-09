<?php

namespace Mrterryh\Repositories\Contracts;

interface RepositoryInterface
{
	/**
	 * Returns all resources for the table.
	 * @param  array  $select An array containing the names of the columns to select.
	 * @return mixed
	 */
	public function all(array $select = array('*'));

	/**
	 * Returns all resources that match the given criteria.
	 * @param  array  $conditionals A key-value array of conditionals (name => Terry, etc)
	 * @param  array  $select       An array containing the names of the columns to select.
	 * @return mixed
	 */
	public function allWhere(array $conditionals, array $select = array('*'));

	/**
	 * Returns all resources, paginated.
	 * @param  integer $perPage The number of resources to display per page.
	 * @param  array   $select  An array containing the names of the columns to select.
	 * @return mixed
	 */
	public function paginate($perPage = 10, array $select = array('*'));

	/**
	 * Returns all resources that match the given criteria, paginated.
	 * @param  array   $conditionals A key-value array of conditionals (name => Terry, etc)
	 * @param  integer $perPage      The number of resources to display per page.
	 * @param  array   $select       An array containing the names of the columns to select.
	 * @return mixed
	 */
	public function paginateWhere(array $conditionals, $perPage = 10, array $select = array('*'));

	/**
	 * Creates a new resource with the data provided.
	 * @param  array  $data A key-value array of the data to insert.
	 * @return mixed
	 */
	public function create(array $data);

	/**
	 * Updates the resource with the given ID, with the data provided.
	 * @param  integer $id   The ID of the resource to update.
	 * @param  array   $data A key-value array of the data to replace.
	 * @return mixed
	 */
	public function update($id, array $data);

	/**
	 * Deletes the resource with the given ID.
	 * @param  integer $id The ID of the resource to delete.
	 * @return mixed
	 */
	public function delete($id);

	/**
	 * Returns the resource with the given ID.
	 * @param  integer $id     The ID of the resource to fetch.
	 * @param  array   $select An array containing the names of the columns to select.
	 * @return mixed
	 */
	public function find($id, array $select = array('*'));

	/**
	 * Returns the single resource that matches the provided criteria.
	 * @param  array  $conditionals A key-value array of conditionals (name => Terry, etc)
	 * @param  array  $select       An array containing the names of the columns to select.
	 * @return mixed
	 */
	public function getWhere(array $conditionals, array $select = array('*'));
}