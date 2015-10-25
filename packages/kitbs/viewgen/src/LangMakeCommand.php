<?php

namespace Kitbs\Viewgen;

use Illuminate\Console\Command;
use Schema;
use App;

class LangMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:lang:model
                            {name : The name of the model.}
                            {lang? : The language folder to save the file to.}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new language file based on a model\'s attributes.';

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
        $name = $this->argument('name');

        if ($name == 'all!') {
            $models = glob(app_path('*.php'));
            $models = array_map(function($value) {
                return str_replace('.php', '', basename($value));
            }, $models);
        }
        else {
            $models = [$name];
        }

        foreach ($models as $modelName) {

            $path = $this->getPath($modelName);

            $this->makeDirectory($path);

            if (file_exists($path)) {
                if ($this->confirm('File ['.$path.'] already exists. Do you wish to overwrite it?')) {
                    $this->createLang($path, $modelName);
                }
            } else {
                $this->createLang($path, $modelName);
            }     
        }
    }

    /**
     * Generate the language file.
     *
     * @param string $path The path of the language file.
     * @return void
     */
    protected function createLang($path, $modelName)
    {
        $contents = $this->getLangContents($modelName);

        file_put_contents($path,$contents);

        $this->info('Language file created successfully.');
    }

    /**
     * Generate the contents of the Lang file.
     *
     * @return string
     */
    protected function getLangContents($modelName)
    {

        $name = App::getNamespace().$modelName;

        $model = new $name;
        $table = $model->getTable();

        if (Schema::hasTable($table)) {

            $fields = $this->getFieldsList($table);
            $longest = $this->getLongestFieldLength($fields);
            
            $title = $this->getFieldLabel($modelName);

            $contents = "<?php\n\nreturn [\n";
            $contents .= "\t'name'       => '$title',\n";
            $contents .= "\t'attributes' => [\n";

            foreach ($fields as $field) {
                $label = $this->getFieldLabel($field);
                $pad = str_repeat(' ', $longest-strlen($field));
                $contents .= "\t\t'$field'     $pad => '$label',\n";
                $help = $this->getFieldHelp($field, strtolower($title));
                $contents .= "\t\t'{$field}_help'$pad => '$help',\n";
            }

        }
        else {
            $this->error("Table [$table] does not exist.");
        }

        $contents .= "\t]\n";
        $contents .= "];";

        return $contents;
    }
	
	protected function getFieldsList($table)
	{
		$fields = Schema::getColumnListing($table);
		
		$ignore = ['id', 'name', 'code', 'description', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by'];
		
		return array_diff($fields, $ignore);
	}

    protected function getFieldLabel($field)
    {
        if ($field == 'id') return 'ID';

        $field = str_replace('_id', '', $field);
        $label = ucwords(str_replace('_', ' ', snake_case($field)));
        
        if (stripos($field, 'is_') === 0) {
            $label = substr($label, 3).'?';
        }
        
        return $label;
    }

    protected function getFieldHelp($field, $model = null)
    {

        $field = preg_replace(['/_id$/', '/_at$/'], ['','_date'], $field);
        $label = str_replace('_', ' ', snake_case($field));

        if (stripos($field, 'is_') === 0) {
            $label = substr($label, 3);
            $label = "Is the $model $label?";
        }
        else {
            if ($label == 'id') $label = 'ID';
            $label = "The $label of the $model.";
        }
        
        return $label;
    }

    protected function getLongestFieldLength($fields)
    {
        uasort($fields,function($a,$b){
            return strlen($b)-strlen($a);
        });
        return strlen(head($fields));
    }

    /**
     * Create the directory for the Lang if it does not already exist.
     * 
     * @param  string $path The full path of the Lang file.
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
     * Get the full path for the Lang file.
     * 
     * @param  string $name The name of the Lang.
     * @return string
     */
    protected function getPath($name)
    {
        $language = $this->argument('lang') ?: App::getLocale();
        return base_path() . '/resources/lang/' .$language . '/models/' . snake_case($name) . '.php';
    }
}
