<?php

class Setup 
{

	private static $projectName = "{{projectName}}";
	private static $modules     = "{{modules}}";
	private static $requirements = array(
		array(
			'classes' => array(
				'ZipArchive' => 'zip',
				'DOMDocument' => 'dom',
				'XMLWriter' => 'XMLWriter'
			),
			'functions' => array(
				'xml_parser_create'     => 'libxml',
				'mb_detect_encoding'    => 'mb multibyte',
				'ctype_digit'           => 'ctype',
				'json_encode'           => 'JSON',
				'gd_info'               => 'GD',
				'gzencode'              => 'zlib',
				'iconv'                 => 'iconv',
				'simplexml_load_string' => 'SimpleXML',
				'hash'                  => 'HASH Message Digest Framework',
				'curl_init'             => 'curl',
			),
			'defined' => array(
				'PDO::ATTR_DRIVER_NAME' => 'PDO'
			),
		)
	);


	/*
		Check dependencies
	*/
	static public function checkDependencies() {
		$error = '';
		$missingDependencies = array();

		// do we have PHP 5.4.0 or newer?
		if(version_compare(PHP_VERSION, '5.4.0', '<')) {
			$error.='PHP 5.4.0 is required. Please ask your server administrator to update PHP to version 5.4.0 or higher.<br/>';
		}

		foreach (self::$requirements[0]['classes'] as $class => $module) {
			if (!class_exists($class)) {
				$missingDependencies[] = array($module);
			}
		}

		foreach (self::$requirements[0]['functions'] as $function => $module) {
			if (!function_exists($function)) {
				$missingDependencies[] = array($module);
			}
		}

		foreach (self::$requirements[0]['defined'] as $defined => $module) {
			if (!defined($defined)) {
				$missingDependencies[] = array($module);
			}
		}

		if(!empty($missingDependencies)) {
			$error .= 'As seguintes dependencias são necessárias:<br/>';
		}
		
		foreach($missingDependencies as $missingDependency) {
			$error .= '<li>'.$missingDependency[0].'</li>';
		}
		
		if(!empty($missingDependencies)) {
			$error .= '</ul><p style="text-align:center">Contate seu administrator de servidor.</p>';
		}

		// do we have write permission?
		if(!is_writable('.')) {
			$error.='O diretório específicado não tem permissão de escrita.<br/>';
		}

		return($error);
	}

	/*

	*/
	public static function showHeader()
	{
		echo '<!DOCTYPE html>
					<html>
						<head>
							<title>'. self::$projectName .' Setup</title>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
							<link rel="stylesheet" href="https://owncloud.org/setupwizard/styles.css" type="text/css" media="screen" />
							<style type="text/css">
							body {
								text-align:center;
								font-size:13px;
								color:#666;
								font-weight:bold;
							}
							</style>
						</head>
						<body id="body-login">
						<header>
								<h1 color="white">'.self::$projectName.'</h1>
							<div id="header">
							</div></header>';
	}

	/*
		Exibe a tela de boas-vindas
	*/
	public static function showWelcome()
	{
		$content = 'Bem-vindo ao '. self::$projectName .'.<br />Este instalador irá checar todas as dependencias, baixar a nova versão do '. self::$projectName .' e instalar em alguns passos.';

		Setup::showContent('Bem-vindo', $content, 1);
	}

	/*
		Exibe a tela de boas-vindas
	*/
 	public static function showContent($title, $content, $nextpage=''){

		echo '<div id="login">
				<br />
				<p style="text-align:center; font-size:28px; color:#444; font-weight:bold;">'.$title.'</p><br />
				<p style="text-align:center; font-size:13px; color:#666; font-weight:bold; ">'.$content.'</p>
				<form method="get">
				<input type="hidden" name="step" value="'.$nextpage.'" />';

		if($nextpage === 2) {
			echo ('<p style="padding-left:0.5em; padding-right:0.5em">Enter a single "." to install in the current directory, or enter a subdirectory to install to:</p>
				<input type="text" style="margin-left:0; margin-right:0" name="directory" value="owncloud" required="required" />');
		}
		
		if($nextpage === 3) {
			echo ('<input type="hidden" value="'.$_GET['directory'].'" name="directory" />');
		}

		if($nextpage<>'') {
			echo '<input type="submit" id="submit" class="login" style="margin-right:100px;" value="Próximo" />';
		}
			
		echo('</form></div>');
	}


	/*
	 Shows the check dependencies screen
	*/
	public static function showCheckDependencies() {
		$error=Setup::checkDependencies();
		if($error=='') {
			$txt='Todas as depedencias encontradas';
			Setup::showContent('Dependency check',$txt,2);
		}else{
			$txt='Depedencias nao encontradas.<br />'.$error;
			Setup::showContent('Dependency check',$txt);
		}
	}

	/**
	* Performs the ownCloud install.
	* @return string with error messages
	*/
	public static function install()
	{
	
		$error = '';
		$directory = $_GET['directory'];

		// Test if folder already exists
		if(file_exists('./'.$directory.'/status.php')) {
			return 'The selected folder seems to already contain a ownCloud installation. - You cannot use this script to update existing installations.';
		}

		// downloading latest release
		if (!file_exists('oc.zip')) {
			$error .= Setup::getFile('https://download.owncloud.org/download/community/owncloud-latest.zip','oc.zip');
		}

		// unpacking into owncloud folder
		$zip = new ZipArchive;
		$res = $zip->open('oc.zip');
		if ($res==true) {
			// Extract it to the tmp dir
			$owncloud_tmp_dir = 'tmp-owncloud'.time();
			$zip->extractTo($owncloud_tmp_dir);
			$zip->close();

			// Move it to the folder
			if ($_GET['directory'] === '.') {
				foreach (array_diff(scandir($owncloud_tmp_dir.'/owncloud'), array('..', '.')) as $item) {
					rename($owncloud_tmp_dir.'/owncloud/'.$item, './'.$item);
				}
				rmdir($owncloud_tmp_dir.'/owncloud');
			} else {
				rename($owncloud_tmp_dir.'/owncloud', './'.$directory);
			}
			// Delete the tmp folder
			rmdir($owncloud_tmp_dir);
		} else {
			$error.='unzip of owncloud source file failed.<br />';
		}

		// deleting zip file
		$result=@unlink('oc.zip');
		if($result==false) $error.='deleting of oc.zip failed.<br />';
		return($error);
	}


	/**
	* Shows the install screen
	*/
	public static function showInstall() {
		$error=Setup::install();

		if($error=='') {
			$txt='ownCloud is now installed';
			Setup::showContent('Success',$txt,3);
		}else{
			$txt='ownCloud is NOT installed<br />'.$error;
			Setup::showContent('Error',$txt);
		}
	}

	public static function showFooter()
	{
		echo '</body></html>';
	}
}

$step = (isset($_GET['step'])) ? $_GET['step'] : 0;

Setup::showHeader();

switch ($step) {
 	case 0:
 		Setup::showWelcome();
 		break;
 	case 1:
 		Setup::showCheckDependencies();
 		break;

 	case 2:
 		Setup::showInstall();
 		break;	
 	
 	default:
 		Setup::showWelcome();
 		break;
 } 

Setup::showFooter();