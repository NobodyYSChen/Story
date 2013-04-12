<?php
	class Configuration
	{
		//-----------------DataBase----------------------------------
		const DATABASE = 'test';
		const ADDRESS  = 'p:localhost';
		const USER     = 'sa';
		const PASSWORD = 'sa';
		//-----------------Router------------------------------------
		const Controlor = 'Home';
		const Action = 'Index';
		const ErrorControlor = 'Error';
		const ErrorAction = 'UrlError';
		const URLSeparator = '__';
		const ParameterSeparator = '&';
		const UrlSuffix = '.fab';
	}
?>