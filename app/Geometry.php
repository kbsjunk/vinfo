<?php

namespace Vinfo;

use Illuminate\Database\Eloquent\Model;
use Kitbs\Geoimport\HasGeometry;

class Geometry extends Model
{
    use HasGeometry;

	protected $casts = [
		'geometry' => 'geometry',
		'centroid' => 'geometry',
	];

}
