<?php

namespace Kitbs\Viewgen;

use Illuminate\Console\Command;
use Schema;
use App;
use Lang;
use Exception;


class ViewMakeCommand extends Command
{
	/**
     * The name and signature of the console command.
     *
     * @var string
     */
	protected $signature = 'make:view:model
                            {model : The name of the model to base the views on.}
                            {templates? : Comma-separated list of names of the views to make. (All if blank).}
                            {--extends=layouts/default : The parent Blade template that the views @extends().}';
	// {--sections= : A comma-separated list of @section()s to include in the file.}

	/**
     * The console command description.
     *
     * @var string
     */
	protected $description = 'Create a new Blade template view from a model.';

	protected $options = [];
	protected $model;
	protected $table;

	/**
     * Create a new command instance.
     *
     * @return void
     */
	public function __construct()
	{
		parent::__construct();
	}

	/**
     * Execute the console command.
     *
     * @return mixed
     */
	public function handle()
	{

		$this->options['__MODEL__']      = snake_case($this->argument('model'));
		$this->options['__MODELS__']     = str_plural($this->options['__MODEL__']);
		$this->options['__CONTROLLER__'] = str_plural($this->argument('model')).'Controller';
		$this->options['__LANG__']       = snake_case($this->argument('model'));
		$this->options['__VIEW__']       = str_plural($this->options['__LANG__']);
		$this->options['__EXTENDS__']    = $this->option('extends');

		$model = App::getNamespace().$this->argument('model');

		try {
			$this->model = new $model;
		}
		catch (Exception $e)
		{
			$this->error("Model [$model] does not exist.");
		}

		$this->options['__ID__'] = $this->model->getKeyName();

		$this->table = $this->model->getTable();

		if (!Schema::hasTable($this->table)) {
			$this->error("Table [$table] does not exist.");
		}

		if ($templates = $this->argument('templates')) {
			$templates = explode(',', $templates);
		}
		else {
			$templates = [
				'index',
				'create',
				'edit',
				'form',
				// 'show',
			];
		}

		foreach ($templates as $template) {

			$path = $this->getPath($this->options['__VIEW__'], $template);

			$this->makeDirectory($path);

			if (file_exists($path)) {
				if ($this->confirm('View ['.$template.'] already exists. Do you wish to overwrite it?')) {
					$this->createView($template, $path);
				}
			} else {
				$this->createView($template, $path);
			}     

		}
	}

	/**
     * Generate the Blade view.
     *
     * @param string $path The path of the view.
     * @return void
     */
	protected function createView($template, $path)
	{
		$contents = $this->getViewContents($template);

		file_put_contents($path,$contents);

		$this->info('View ['.$template.'] created successfully at ['.$path.'].');
	}

	/**
     * Generate the contents of the view file.
     *
     * @return string
     */
	protected function getViewContents($template)
	{
		$options = $this->options;

		if ($template == 'form') {

			$textTemplate = file_get_contents(dirname(__FILE__).'/../templates/form-text.template');
			$checkboxTemplate = file_get_contents(dirname(__FILE__).'/../templates/form-checkbox.template');

			$fieldContents = '';

			foreach ($this->getColumns($this->table) as $field) {
				$options['__FIELD__'] = $field;
				$options['__TYPE__'] = in_array($field, ['email', 'password', 'url']) ? $field : 'text';

				if (preg_match('/^is_/', $field)) {
					$fieldContents .= $this->prepareTemplate($checkboxTemplate, $options);
				}
				else {
					$fieldContents .= $this->prepareTemplate($textTemplate, $options);
				}
			}

			$options['__FIELDS__'] = $fieldContents;

			if ($this->model->translatedAttributes) {
				$translationTemplate = file_get_contents(dirname(__FILE__).'/../templates/translations.template');
				$translationContents = $this->prepareTemplate($translationTemplate, $options);
			}
			else {
				$translationContents = '';
			}
			
			$options['__TRANSLATIONS__'] = $translationContents;

		}
		elseif ($template == 'index') {

			$columnTemplate = "\t\t\t\t<th__CLASS__>{{ trans('models/__LANG__.attributes.__FIELD__') }}</th>";
			$fieldTemplate = "\t\t\t\t<td>{{ \$__MODEL__->__FIELD__ }}</td>";
			$linkTemplate = "\t\t\t\t<td><a href=\"{{ action('__CONTROLLER__@edit', \$__MODEL__->id) }}\">{{ \$__MODEL__->__FIELD__ }}</a></td>";
			$translatedColumnTemplate = "\t\t\t\t@if (App::getLocale() != 'en')
\t\t\t\t\t<th>{{ trans('models/__VIEW__.attributes.name') }} ({{ Punic\Language::getName('en', App::getLocale()) }})</th>
\t\t\t\t@endif";
			$translatedFieldTemplate = "\t\t\t\t@if (App::getLocale() != 'en')
\t\t\t\t\t<td>{{ \$__MODEL__->name_en }}</td>
\t\t\t\t@endif";

			$columns = [];
			$fields = [];

			$fieldOptions = [
				'__LANG__'       => $this->options['__LANG__'],
				'__MODEL__'      => $this->options['__MODEL__'],
				'__CONTROLLER__' => $this->options['__CONTROLLER__'],
			];

			foreach ($this->getColumns($this->table) as $field) {
				$fieldOptions['__FIELD__'] = $field;
				$fieldOptions['__CLASS__'] = ($field == 'code' ? ' class="col-sm-1"' : '');

				$columns[] = $this->prepareTemplate($columnTemplate, $fieldOptions);
				if ($field=='name') {
					$fields[] = $this->prepareTemplate($linkTemplate, $fieldOptions);
				}
				else {
					$fields[] = $this->prepareTemplate($fieldTemplate, $fieldOptions);
				}
			}

			$options['__COLUMNS__'] = implode("\n", $columns);
			$options['__FIELDS__'] = implode("\n", $fields);

			if ($this->model->translatedAttributes) {
				$translatedColumn = $this->prepareTemplate($translatedColumnTemplate, $options);
				$translatedField = $this->prepareTemplate($translatedFieldTemplate, $options);
			}
			else {
				$translatedColumn = '';
				$translatedField = '';
			}

			$options['__TRANSLATED_COLUMN__'] = $translatedColumn;
			$options['__TRANSLATED_FIELD__'] = $translatedField;

		}

		$templates = file_get_contents(dirname(__FILE__).'/../templates/'.$template.'.template');
		$contents = $this->prepareTemplate($templates, $options);



		return $contents;
	}

	protected function getColumns($table)
	{
		$fields = Schema::getColumnListing($this->table);

		$traits = class_uses_recursive(get_class($this->model));

		$fields = array_except(array_flip($fields), ['id', 'created_at', 'updated_at', 'deleted_at']);

		$fields = array_keys($fields);

		if (in_array('Dimsav\\Translatable\\Translatable', $traits)) {
			$fields = array_merge($fields, $this->model->translatedAttributes);    
		}

		return $fields;
	}

	protected function prepareTemplate($template, $values)
	{
		return str_replace(array_keys($values), array_values($values), $template);
	}

	/**
     * Create the directory for the view if it does not already exist.
     * 
     * @param  string $path The full path of the view file.
     * @return void
     */
	protected function makeDirectory($path)
	{
		$dir = dirname($path);

		if (!file_exists($dir)) {
			mkdir($dir, 0777, true);
		}
	}

	/**
     * Get the full path for the view file.
     * 
     * @param  string $name The name of the view folder.
     * @param  string $view The name of the view file.
     * @return string
     */
	protected function getPath($folder, $file)
	{
		return base_path() . '/resources/views/' . $folder . '/' . $file . '.blade.php';
	}
}
