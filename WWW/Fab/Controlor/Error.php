<?php
	/**
	* 
	*/
	class Error extends Controlor
	{
		
		function __construct($Router)
		{
			parent::__construct($Router);
		}

		//------------Actions-------------
		public function UrlError()
		{
			echo "Error->UrlError";
		}
	}
?>