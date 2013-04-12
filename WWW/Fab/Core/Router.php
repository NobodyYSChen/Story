<?php
	/**
	* 
	*/
	class Router 
	{
		private $Controlor;

		private $Action;

		private $Parameters = array();
		public function GetParameters()
		{
			return $this->Parameters;
		}
		public function Route()
		{
			$index = stripos($_SERVER['REQUEST_URI'], Configuration::UrlSuffix); echo "{$index}";
			$url = substr($_SERVER['REQUEST_URI'], 1 , $index-1 );
			if( 0 == strlen($url) )
			{ 
				$this->Controlor = Configuration::Controlor;
				$this->Action = Configuration::Action;
			}
			else
			{
				$UrlParts = explode(Configuration::URLSeparator, $url);
				if( 2 <= count($UrlParts) )
				{
					$this->Controlor = $UrlParts[0];
					$this->Action = $UrlParts[1];
					if( isset($UrlParts[2]) )
					{
						$PamameterParts = explode(Configuration::ParameterSeparator, $UrlParts[2]); 
						foreach ($PamameterParts as $ParameterStr)
						{
							$Param = explode('=', $ParameterStr );
							$this->Parameters[$Param[0]] = $Param[1];
						}
					}
				}
				else
				{
					$this->Controlor = Configuration::ErrorControlor;
					$this->Action = Configuration::ErrorAction;
				}
				//--------------Get Post Data-------------------------------------------------
			   array_merge($this->Parameters,$_REQUEST);
			}	
			$_controlor = $this->Controlor;
			$_controlor = new $_controlor($this);
			$_action = $this->Action;
			return $_controlor->$_action();
		}
		public function  ReRoute($Controlor,$Action)
		{
			$this->Controlor = $Controlor;
			$this->Action = $Action;
			$_controlor = $this->Controlor;
			$_controlor = new $_controlor($this);
			$_action = $this->Action;
			return $_controlor->$_action();
		}
	}
?>