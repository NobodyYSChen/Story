<?php
	require_once 'Object.php';
	require_once 'DomainObject.php';
 	class Unitwork extends Object
	{
		static $NEW = array();
		static $CLEAN = array();
		static $DIRTY = array();
		static $DELETED = array();
		static function Commit()
		{
			self::DoInsert();
			self::DoUpdate();
			self::DoDelete();
			self::$NEW = array();
			self::$CLEAN = array();
			self::$DIRTY = array();
			self::$DELETED = array();
		}
		static function GetGlobalKey(DomainObject $obj)
		{
			return get_class($obj).$obj->ID;
		}
		static function Exist(DomainObject $obj)
		{}
		static function LoadFromMap($Identity)
		{
			if (Unitwork::$CLEAN[$Identity] != null)
				return Unitwork::$CLEAN[$Identity];
			elseif (Unitwork::$DIRTY[$Identity] != null)
				return Unitwork::$DIRTY[$Identity];
			else 
				return null;
		}
		static function RegisterNew(DomainObject $obj)
		{
			array_push(self::$NEW, $obj);
		}
		static function RegisterClean(DomainObject $obj)
		{
			$GlobalKey = self::GetGlobalKey($obj);
			for($i= 0 ; $i< count(self::$NEW);$i++)
			{
				if(self::$NEW[$i] === $obj)
					unset(self::$NEW[$i]);
				break;
			}
			unset(self::$DIRTY[$GolbalKey]);
			self::$CLEAN[$GlobalKey] = $obj;
		}
		static function RegisterDirty(DomainObject $obj)
		{
			$GlobalKey = self::GetGlobalKey($obj);
			if(isset(self::$CLEAN[$GlobalKey]))
			{
				unset(self::$CLEAN[$GlobalKey]);
				self::$DIRTY[$GlobalKey] = $obj;
			}
		}
		static function RegisterDeleted(DomainObject $obj)
		{
			$GlobalKey = self::GetGlobalKey($obj);
			/*for($i= 0 ; $i< count(self::$NEW);$i++)
			{
				if(self::$NEW[$i] === $obj);
				unset(self::$NEW[$i]);
				break;
			}*/
			unset(self::$CLEAN[$GlobalKey]);
			unset(self::$DIRTY[$GlobalKey]);
			self::$DELETED[$GlobalKey] = $obj;
		}
		static function DoInsert()
		{
			foreach (self::$NEW as $obj)
			{
				$obj->CreateAction();
			}
		}
		static function DoUpdate()
		{
			foreach (self::$DIRTY as $obj) 
			{
				$obj->UpdateAction();
			}
		}
		static function DoDelete()
		{
			foreach (self::$DELETED as $obj)
			{
				$obj->DeleteAction();
			}
		}

	}
?>