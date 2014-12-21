<?php

class DebugController extends BaseController {

	/**
	*
	*/
	public function __construct() {

		# Make sure BaseController construct gets called
		parent::__construct();

	}

	/**
	* Special method that gets triggered if the user enters a URL for a method that does not exist
	*
	* @return String
	*/
	public function missingMethod($parameters = array()) {

		return 'Method "'.$parameters[0].'" not found';

	}

	/**
	* http://localhost/debug/index
	*
	* @return String
	*/
	public function getIndex() {

		echo '<pre>';

		echo '<h1>environment.php</h1>';
		$path   = base_path().'/environment.php';

		try {
			$contents = 'Contents: '.File::getRequire($path);
			$exists = 'Yes';
		}
		catch (Exception $e) {
			$exists = 'No. Defaulting to `production`';
			$contents = '';
		}

		echo "Checking for: ".$path.'<br>';
		echo 'Exists: '.$exists.'<br>';
		echo $contents;
		echo '<br>';

		echo '<h1>Environment</h1>';
		echo App::environment().'</h1>';

		echo '<h1>Debugging?</h1>';
		if(Config::get('app.debug')) echo "Yes"; else echo "No";

		echo '<h1>Database Config</h1>';
		print_r(Config::get('database.connections.mysql'));

		echo '<h1>Test Database Connection</h1>';
		try {
			$results = DB::select('SHOW DATABASES;');
			echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
			echo "<br><br>Your Databases:<br><br>";
			print_r($results);
		}
		catch (Exception $e) {
			echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
		}

		echo '</pre>';

	}


	/**
	* Trigger an error to test debug display settings
	* http://localhost/debug/trigger-error
	*
	* @return Exception
	*/
	public function getTriggerError() {

		# Class Foobar should not exist, so this should create an error
		$foo = new Foobar;

	}


	/**
	* Print all available routes
	* http://localhost/debug/routes
	*
	* @return String
	*/
	public function getRoutes() {

		$routeCollection = Route::getRoutes();

		foreach ($routeCollection as $value) {
	    	echo "<a href='/".$value->getPath()."' target='_blank'>".$value->getPath()."</a><br>";
		}

	}


	


	/**
	* Old seeder - have since moved to proper seeding
	* http://localhost/debug/seed-books
	*
	* @return String*/
	
	public function getSeedGoals() {

		return 'This seed will no longer work because the books table is no longer embedded with the author.';

		# Build the raw SQL query
		$sql = "INSERT INTO goals (name,description,users_id) VALUES
		        ('testing123','this is a test','1'),
		        ('testing456','this is another test','2'),
		        ('testing789', 'this is test 3','1')
		        ";

		# Run the SQL query
		echo DB::statement($sql);

		# Get all the books just to test it worked
		$gaols = DB::table('goals')->get();

		# Print all the books
		echo Paste\Pre::render($goals,'');

	}

	/*
	* Test to make sure we can connect to MySQL
	*
	* @return String
	*/
	public function getMysqlTest() {

	    # Print environment
	    echo 'Environment: '.App::environment().'<br>';

	    # Use the DB component to select all the databases
	    $results = DB::select('SHOW DATABASES;');

	    # If the "Pre" package is not installed, you should output using print_r instead
	    echo Pre::render($results);

	}

	/**
	* Outputs Session and Cookie data in various forms.
	* Used to understand how Sessions and Cookies are working
	*/
	public function getSessionsAndCookies() {
		 # Log in check
	    if(Auth::check())
	        echo "You are logged in: ".Auth::user();
	    else
	        echo "You are not logged in.";
	    echo "<br><br>";

	    # Cookies
	    echo "<h1>Your Raw, encrypted Cookies</h1>";
	    echo Paste\Pre::render($_COOKIE,'');

	    # Decrypted cookies
	    echo "<h1>Your Decrypted Cookies</h1>";
	    echo Paste\Pre::render(Cookie::get(),'');
	    echo "<br><br>";

	    # All Session files
	    echo "<h1>All Session Files</h1>";
	    $files = File::files(app_path().'/storage/sessions');

	    foreach($files as $file) {
	        if(strstr($file,Cookie::get('laravel_session'))) {
	            echo "<div style='background-color:yellow'><strong>YOUR SESSION FILE:</strong><br>";
	        }
	        else {
	            echo "<div>";
	        }
	        echo "<strong>".$file."</strong>:<br>".File::get($file)."<br>";
	        echo "</div><br>";
	    }

	    echo "<br><br>";

	    # Your Session Data
	    $data = Session::all();
	    echo "<h1>Your Session Data</h1>";
	    echo Paste\Pre::render($data,'Session data');
	    echo "<br><br>";

	    # Token
	    echo "<h1>Your CSRF Token</h1>";
	    echo Form::token();
	    echo "<script>document.querySelector('[name=_token]').type='text'</script>";
	    echo "<br><br>";
	}

}