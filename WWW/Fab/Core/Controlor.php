<?php
	abstract class Controlor 
	{
		private $Router;
		public function GetRouter()
		{
			return $this->Router;
		}
		public function __construct($Router)
		{
			$this->Router = $Router;
		}
	}
?>