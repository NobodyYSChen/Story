<?php
	/**
	* 
	*/
	class Home extends Controlor
	{
		
		function __construct($Router)
		{
			parent::__construct($Router);
		}

		//----------Actions-------------
		public function Index()
		{
			$this->GetRouter()->ReRoute("Error","UrlError");
		}
		public function in()
		{
			echo "Home->in";
			print_r($this->GetRouter()->GetParameters());
		}
	}
?>