			<div class="table-responsive">
				<table class="table table-condensed table-valign-middle">
					<thead>
						<tr>
							<th class="col-md-2 col-sm-3">
								Language
							</th>
							@foreach($country->translatedAttributes as $attribute)
							<th class="col-md-2">
								{{ trans('models/country.attributes.'.$attribute) }}
							</th>
							@endforeach
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($country->translations as $translation)
						<tr>
							<th class="text-right">
								{{ Punic\Language::getName($translation->locale, $translation->locale) }}
							</th>
							@foreach($country->translatedAttributes as $attribute)
							<td>
								{!! Form::text("{$translation->locale}[{$attribute}]", $translation->$attribute, ['class' => 'form-control input-sm', 'lang' => $translation->locale, 'placeholder' => trans('models/country.attributes.name', [], null, $translation->locale)]) !!}
							</td>
							@endforeach
						</tr>
						@endforeach
						@foreach(array_diff(Config::get('translatable.locales'), $country->translations->pluck('locale')->toArray()) as $locale)
						<tr>
							<th class="text-right">
								{{ Punic\Language::getName($locale, $locale) }}
							</th>
							@foreach($country->translatedAttributes as $attribute)
							<td>
								{!! Form::text("{$locale}[{$attribute}]", $country->translate('en')->$attribute, ['class' => 'form-control input-sm input-default', 'lang' => $locale, 'placeholder' => trans('models/country.attributes.name', [], null, $locale)]) !!}
							</td>
							@endforeach
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>