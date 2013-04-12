<?php
	require_once 'Object.php';
	require_once 'Map.php';
	require_once 'Unitwork.php';
	abstract class DomainObject extends Object
	{
	   
		function __construct()
		{
			$this->ID = 0;
			$this->Verson = 0;
			$this->MarkNew();
		}
		//工作单元注册
		public final function MarkNew()
		{
			Unitwork::RegisterNew($this);
		}
		public final function MarkClean()
		{
			Unitwork::RegisterClean($this);
		}
		public final function MarkDirty()
		{
			Unitwork::RegisterDirty($this);
		}
		public final function MarkDeleted()
		{
			Unitwork::RegisterDeleted($this);
		}
		
		/*protected $Map;
		function Save()
		{
			switch ($this->EntityStatus)
			{
				case EntityStatus::ISNEW :   
					$this->Create($this);
					break;
				case EntityStatus::DIRTY :
					$this->Update($this);
					break;
				case EntityStatus::DELETED :
					$this->Delete($this->ID);
					break;
			}
		}*/
		
		//增删改查
		public final function Create()
		{
			$this->CreateAction();
		}
		abstract function CreateAction();
		
		public final function Update()
		{
			$this->Verson = $this->Verson+1;
			$this->UpdateAction();
		}
		abstract function UpdateAction();
		
		
		public final function Delete()
		{
			$this->Verson = $this->Verson+1;
			$this->DeleteAction();
		}
		abstract function DeleteAction();
		
		private $ID;
		public function _getID()
		{
			return $this->ID;
		}
		public function _setID($value)
		{
			if (is_int($value) && $value>=0)
				$this->ID = $value;
			else 
				throw new Exception('$value is not an integer !');
		}
		private  $Verson;
		public function _getVerson()
		{
			return $this->Verson;
		}
		protected function _setVerson($value)
		{
			$this->Verson = $value;
		}
		
	}
	/*class EntityStatus
	{
		const ISNEW = 0;
		const CLEAN = 1;
		const DIRTY = 2;
		const DELETED = 3;
	}*/
?>