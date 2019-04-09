<?php

namespace Ukadev\Blogfolio\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blogfolio:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Blogfolio install command';

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
        $this->info('## Blogfolio Install ##');

        try{
            $this->call('make:auth');
        }Catch(\Exception $e){}

        $this->call('vendor:publish');

        $content = <<<EOF
<?php
return array(
	'store' => 'database',
	'table' => 'settings',
	'connection' => null,
	'keyColumn' => 'key',
	'valueColumn' => 'value'
);
EOF;
        try {
            $this->info('Overwriting config Settings');
            if(file_exists(base_path() . "/config/settings.php")){
                unlink(base_path() . "/config/settings.php");
            }
            $f = @fopen(base_path() . "/config/settings.php", "w");
            if ($f !== false) {
                fwrite($f, $content);
                fclose($f);
            }
        }Catch(\Exception $e){
            $this->info('Unable to set Settings file: Please set it manually following the next link:');
            $this->info('https://github.com/ukadev/blogfolio/wiki/Generate-Settings-File');
        }
        $this->info('Migrating database');
        $this->call('migrate');
        $this->info('Adding default data to the database');
        $this->call('db:seed', ['--class' => 'BlogfolioSeeder']);
        $this->info('Default data inserted successfully');
        $this->info('You can enter the panel browing this url:');
        $this->info(app('url')->to('/').'/panel');
    }
}
