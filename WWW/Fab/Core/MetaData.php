<?php
	class MetaData
	{
		private $Xml ;
		private $Objects = array();
		private static $Instance;
		private function __constrcut($XmlFilePath)
		{	
			$this->Xml = new new SimpleXMLElement($XmlFilePath);
		}
		static function CreateInstance()
		{
			if( ! self::$Instance)
			{
				self::$Instance = new MetaData();
			}
		}
		function GetTableName($ClassName)
		{
			if( ! isset($Objects[$ClassName]["attr"]["TableName"]))
			{
				$Nodes = $this->Xml->xpath("/DomainObject/Object[@ClassName='{$ClassName}']");
				if(count($Nodes) == 1)
				{
					$Objects[$ClassName]["attr"]["TableName"] = $Nodes[0]->TableName;
				}
				else
				{
					throw new Exception("MetaData is not exsit !", 1);
					
				}
			}
			return $Objects[$ClassName]["attr"]["TableName"];
		}
		function GetPrimaryKey($ClassName)
		{
			if( ! isset($Objects[$ClassName]["attr"]["PrimaryKey"]))
			{
				$Nodes = $this->Xml->xpath("/DomainObject/Object[@ClassName='{$ClassName}']");
				if(count($Nodes) == 1)
				{
					$Objects[$ClassName]["attr"]["PrimaryKey"] = $Nodes[0]->PrimaryKey;
				}
				else
				{
					throw new Exception("MetaData is not exsit !", 1);
					
				}
			}
			return $Objects[$ClassName]["attr"]["PrimaryKey"];
		}
		function GetMapper($ClassName)
		{
			if( ! isset($Objects[$ClassName]["attr"]["Mapper"]))
			{
				$Nodes = $this->Xml->xpath("/DomainObject/Object[@ClassName='{$ClassName}']");
				if(count($Nodes) == 1)
				{
					$Objects[$ClassName]["attr"]["Mapper"] = $Nodes[0]->Mapper;
				}
				else
				{
					throw new Exception("MetaData is not exsit !", 1);
					
				}
			}
			return $Objects[$ClassName]["attr"]["Mapper"];
		}
		function GetClassName($TableName)
		{
			if( ! isset($Objects[$ClassName]["attr"]["ClassName"]))
			{
				$Nodes = $this->Xml->xpath("/DomainObject/Object[@TableName='{$TableName}']");
				if(count($Nodes) == 1)
				{
					$Objects[$ClassName]["attr"]["ClassName"] = $Nodes[0]->ClassName;
				}
				else
				{
					throw new Exception("MetaData is not exsit !", 1);
					
				}
			}
			return $Objects[$ClassName]["attr"]["ClassName"];
		}
		function GetColumns($ClassName)
		{
			$Columns = array();
			$Nodes = $this->Xml->xpath("/DomainObject/Object[@ClassName='{$ClassName}']");
			foreach ($Nodes as $Node) 
			{
				array_push($Columns, $Node->ColumnName);
			}
			return $Columns;
		}
		function GetSetter($ClassName,$ColumnName)
		{
			if( ! isset($this->Objects[$ClassName]["property"]["ColumnName"]))
			{
				$Nodes = $this->Xml->xpath("/DomainObject/Object[@ClassName='{$ClassName}']");
				if(count($Nodes) == 1)
				{
					$this->Objects[$ClassName]["property"]["ColumnName"] = $Nodes[0]->Setter;
				}
				else
				{
					throw new Exception("MetaData is not exsit !", 1);
					
				}
			}
			return $this->Objects[$ClassName]["property"]["Setter"];
		}
		function GetGetter($ClassName,$ColumnName)
		{
			if( ! isset($this->Objects[$ClassName]["property"]["ColumnName"]))
			{
				$Nodes = $this->Xml->xpath("/DomainObject/Object[@ClassName='{$ClassName}']");
				if(count($Nodes) == 1)
				{
					$this->Objects[$ClassName]["property"]["ColumnName"] = $Nodes[0]->Getter;
				}
				else
				{
					throw new Exception("MetaData is not exsit !", 1);
					
				}
			}
			return $this->Objects[$ClassName]["property"]["Getter"];
		}
		
	}
?>