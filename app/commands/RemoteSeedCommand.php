<?php
/**
 * Ejecuta un seeder en el servidor staging
 */
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RemoteSeedCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'db:remote-seed';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Ejecuta un seed en el servidor staging.';

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
	public function fire()
	{
        $class = $this->option('class');
        if(!$class) {
            //echo "Debe indicar el nombre de la clase a ejecutar, con la opción --class=NombreClaseSeeder\n";
            $this->error("\n\n\nDebe indicar el nombre de la clase a ejecutar, con la opción --class=NombreClaseSeeder\n\n\n");
            return false;
        }

        $commands = array(
            'cd /var/www/html',
            'php artisan db:seed --class='.$class,
        );

        if ($this->confirm('Se va a ejecutar el seed en el servidor remoto, el archivo seeder debe existir en el servidor remoto ¿desea continuar? [yes|no]'))
        {
            SSH::run($commands, function($line)
            {
                echo $line.PHP_EOL;
            });
        }
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
        return array(
            array('', InputArgument::OPTIONAL, ''),
        );
    }

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('class', null, InputOption::VALUE_REQUIRED, 'El nombre de la clase del seeder a ejecutar en el servidor remoto.', null),
		);
	}

}
