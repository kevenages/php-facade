# README #

This software is built on a very basic MVP framework.  Controllers are static classes and are available anywhere in the application.

## Basic Configurations ##

	Error Handling: 
		Exceptions are thrown everywhere (as `Exception`) and are captured/extended in the Controllers.

	Application strings: 		
		All strings found in the app are defined in Config/definitions.php
	
	Application configuration: 
		All configuration variables are defined in Config/core.php

## Application ##
	
### Database Handling ###
		
		A basic CRUD framework can be found in Lib/Model.php
		* The framework uses the ADODB/PHP ORM
		* Hack-ables:  $Model->setPrimaryKey('some_key') can be used in place of a WHERE statement
			Eg:  Primary Key is `id`, but we want to query based on `email_address` using only read()
				 -----------------------------
				 $email = "email@someemail.com";
				 //Field name
				 $this->setPrimaryKey('email_address');
				 //Field value
				 $this->id = $email;
				 //Optional: Filter columns to return
				 $this->fields = array('id', 'email_address');
				 $user = $this->read();
				 var_dump($user);
	Model:
		
		Lib/Model.php contains 2 classes.  One is a simpleton (Model), the other is a Static class (DbUtils).  Models require convention and a bit of configuration.
		- Methods:
			* Create
			* Read
			* Update
			* Delete

		- Configuration:
			* All models must contain the following as a minimum:

				Example:

				public $name = 'ModelName';
				public $config = array('table' => 'table_name',
									   'model' => 'Same as $this->name',
									   'primaryKey' => 'id',
									   'schema' => array('some_field' => null,
											  			 'another_field' => 1,
											  			 'more_field' => 'no'
														 )
									   );

			** As you can see, defaults can be set.
			** Custom SELECT queries can be used with $this->rawQuery().

	Request:

		Lib/Request.php is a static HTTP request class.
		- Methods:
			* isPost
			* isPut
			* isGet
			* isDelete
			* isMobile
			* isAjax

	Routing:

		Lib/Route.php is very rudimentary routing layer.  Routes are defined in Config/routes.php and act as a layer between the Controller and the View.

	Sanitization:

		Lib/Sanitize.php is a static sanitization class used to Sanitize user input.
		- Methods:
			* html
			* clean

	Sessions:
		
		Lib/Session is a static class to deal with session vars.  This class starts and destroys a session as well as sets php_ini defaults.

	String:

		Lib/String is a static class that deals with various string functions.
		- Methods:
			* uuid