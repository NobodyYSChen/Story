<?php
	require_once 'Object.php';
	require_once 'MetaData.php';
	abstract Class Map extends Object
	{
		private static $MetaData ;

		function __construct()
		{
			self::$MetaData = MetaData::CreateInstance();
		}
		
		function Final Create(DomainObject $Object)
		{
			$ClassName = get_class($Object);
			$TableName = self::$MetaData->GetTableName($ClassName);
			$Columns = self::$MetaData->GetColumns($ClassName);
			foreach ($Columns as $Column) 
			{
				# code...
			}
		}
		abstract function Delete(DomainObject $Object);
		abstract function Update(DomainObject $Object);
		
		public Final function Load($ID)
		{
			$SELCTSTRING = "SELECT * FROM $this->TableName. WHERE .$this->PrimaryKey = @$this->PrimaryKey";
		}
		abstract function ParseFrom(array $DataRow);
	}
?>
