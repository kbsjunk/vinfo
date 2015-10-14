<?php

namespace Vinfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dimsav\Translatable\Translatable;
use Vinfo\Traits\TranslatableSortable;

class ConsumedReason extends Model
{
	use SoftDeletes;
    use Translatable;
    use TranslatableSortable;
	
    protected $fillable = [
	    'name',
	    'is_drank',
	    'info',
    ];

    public $translatedAttributes = ['name'];

    public function bottles()
    {
    	return $this->hasMany('Vinfo\Bottles');
    }

    protected $casts = [
    	'info' => 'json',
    ];
	
	public function getInfoLabelsAttribute()
	{
		$labels = array_combine(array_keys($this->info), array_keys($this->info));
		
		foreach ($labels as &$label)
		{
			$label = trans('models/consumed_reason.info.'.$label);
		}
		
		return $labels;
	}
	
	public function getInfoFieldsAttribute()
	{
		$labels = $this->info;
		
		foreach ($labels as $key => &$type)
		{
			$type = [
				'type' => $type,
				'label' => trans('models/consumed_reason.info.'.$key),
			];
		}
		
		return $labels;
	}
	
	public function getFieldTypesAttribute()
	{
		$labels = ['text','money','currency','country','rating'];
		
		$labels = array_combine($labels, $labels);
		
		foreach ($labels as &$label)
		{
			$label = trans('models/consumed_reason.field_types.'.$label);
		}
		
		return $labels;
		
	}

}
