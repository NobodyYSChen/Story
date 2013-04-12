<?php
	require_once 'IDataBase.php';
	require_once '../Configuration.php';
	class MySqlDB implements IDataBase
	{
		//--单例----------------------------
		private static $Instance = null;
		private $mysqli = null;
		private function __construct()
		{
			$this->mysqli = new mysqli(Configuration::ADDRESS, Configuration::USER,Configuration::PASSWORD,Configuration::DATABASE);
		}
		function __destruct()
		{
			if(  $this->mysqli)
			{
				//$this->mysqli->kill($this->mysqli->thread_id) ;
			}
		}
		static function CreateInstance()
		{
			if ( ! self::$Instance)
				self::$Instance = new self();
			return self::$Instance;
		}
		
		//--连接----------------------
		
		function ExecuteData($CommandString)
		{
			try 
			{
				$table = array();
				$result = $this->mysqli->query($CommandString); 
				while ($row = $result->fetch_array(MYSQLI_BOTH))
				{
					array_push($table, $row);
				}
				return  $table;
			}
			catch (Exception $ex)
			{
				throw $ex;
			}
			return null;
		}
		function ExecuteNonQuery($CommandString)
		{
			try 
			{
				$result = $this->mysqli->query($CommandString);
				return $this->mysqli->affected_rows;
			}
			catch (Exception $ex)
			{
				throw $ex;
			}
			return 0;
		}
		function ExecuteObject($CommandString)
		{
			try
			{
				$result = $this->mysqli->multi_query($CommandString);
				$row = $result->fetch_array();
				return $row[0];
			}
			catch(Exception $ex)
			{
				throw $ex;
				
			}
			return null;
		}
		function ExecuteTransAction(array $CommandStringArray)
		{
			try
			{
				$IsSuccess = true;
				$this->mysqli->autocommit(false);
				foreach ($CommandStringArray as $Command)
				{
					$Result = $this->mysqli->query($Command);
					if( ! $Result)
					{
						$IsSuccess = false;
						break;
					}
				}
				if($IsSuccess)
				{
					$this->mysqli->commit();
				}
				else
				{
					$this->mysqli->rollback();
				}
				$this->mysqli->autocommit(true);
			}
			catch (Exception $ex)
			{
				throw $ex;
				
			}
			return  $IsSuccess;
		}
		function ExecuteInsert($CommandString)
		{
			try
			{
				$this->mysqli->query($CommandString);
			}
			catch( Exception $ex)
			{}
			return $this->mysqli->insert_id;
		}
	}
?>



 