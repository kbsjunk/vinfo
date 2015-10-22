<?php

namespace Vinfo;

use Illuminate\Database\Eloquent\Model;
use Kitbs\Geoimport\HasGeometry;

class Geometry extends Model
{
    use HasGeometry;
	
	protected $fillable = [
		'name',
		'description',
		'geometry',
		'properties',
	];

	protected $casts = [
		'geometry' => 'geometry',
/* 		'centroid' => 'geometry', */
	];
	
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
		parent::boot();
		
		static::saving(function ($geometry) {
			if ($geometry->isDirty('geometry')) {
				$geometry->quality = $geometry->geometry instanceof \GeoJson\Geometry\Point ? 5 : 10;
			}
			return true;
		});
        
	}
	
	public function geometried()
    {
        return $this->morphTo();
    }

}
