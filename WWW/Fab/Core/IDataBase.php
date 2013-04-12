<?php
	Interface IDataBase
	{
		function ExecuteData($CommandString);
		function ExecuteObject($CommandString);
		//function ExecuteScalar($CommandString);
		function ExecuteNonQuery($CommandString);
		function ExecuteTransAction(array $CommandStringArray);
	}
?>