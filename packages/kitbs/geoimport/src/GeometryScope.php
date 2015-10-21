<?php

namespace Kitbs\Geoimport;

use Illuminate\Database\Eloquent\ScopeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class GeometryScope implements ScopeInterface
{
	protected $binary;

	public function __construct($binary = false)
	{
		$this->binary = $binary;
	}

	/**
	 * Apply the scope to a given Eloquent query builder.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
	 * @return void
	 */
	public function apply(Builder $builder, Model $model)
	{
		$columns = $model->getGeometries();

		$query = $builder->getQuery();

		$select = ['*'];

		foreach ($columns as $column) {
			if ($this->binary) {
				$select[] = 'AsBinary(`'.$column.'`) AS `'.$column.'`';
			}
			else {
				$select[] = 'AsText(`'.$column.'`) AS `'.$column.'`';
			}
		}

		// $builder->onDelete(function (Builder $builder) {
		// 	$column = $this->getDeletedAtColumn($builder);

		// 	return $builder->update([
		// 		$column => $builder->getModel()->freshTimestampString(),
		// 		]);
		// });

		return $query->selectRaw(implode(', ', $select));
	}

	/**
	 * Remove the scope from the given Eloquent query builder.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
	 * @return void
	 */
	public function remove(Builder $builder, Model $model)
	{
		$columns = $model->getGeometries();

		$query = $builder->getQuery();

        // $query->wheres = collect($query->wheres)->reject(function ($where) use ($column) {
        //     return $this->isSoftDeleteConstraint($where, $column);
        // })->values()->all();
	}
}