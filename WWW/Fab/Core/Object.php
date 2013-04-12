<?php
	class Object
	{
		function __set($Property,$Value)
		{
			$Property = "_set".$Property;
			if(method_exists($this,$Property))
			{
				return $this->$Property($Value);
			}
			throw new Exception("Property does not exist!");
		}
		function __get($Property)
		{
			$Property = "_get".$Property;
			if(!method_exists($this, $Property))
			{
				throw new Exception("Property does not exist!");
			}
			return $this->$Property();
		}
	}
?>