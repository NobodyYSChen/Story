<?php
	require_once 'Object.php';
	class QueryObejct extends Object
	{
		private $SqlString = null;
		private $Parameters = array();
		function _setSqlString($value)
		{
			$this->SqlString = $value;
		}
		function AddParameter($Name,$Value)
		{
			$this->Parameters[$Name] = $Value;
		}
		function BuildCommandString()
		{
			if($this->SqlString != null)
			{}
		}
	}
?>