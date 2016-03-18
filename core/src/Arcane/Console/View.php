<?php 

namespace Arcane\Console;

use Arcane\Console\Project;

class View
{
	/*
		Nome do projeto
	 */
	private $projectName; 

	/* 
		Nome do modulo
	*/
	private $module;
	
	/*
		Diretorio do novo modulo
	*/
	private $path;

	/*
		Caminho do template
	*/
	private $templateDir;

	/* 
		Receber a entrada da requisição da criação do modulo
	*/
	public function init($definition)
	{
		$path = $this->setDefinition($definition);

		if (! Project::hasProject($this->projectName)) {
			return 'Project not found';
		}

		$this->mkdirModule($path);

		//$this->createIndexModule();

		return true;
	}

	/*
		
	 */
	public function setDefinition($params)
	{
		@list($project, $module, $nameView) = explode('.', $params);

		$this->projectName = $project;

		$projectDir = strtolower($project) . DS;

		if (strtolower($module)=='starter' || !isset($nameView)) {
			$this->viewDir  = 'starter' . DS . 'views';	
			$this->viewController  = 'starter' . DS . 'controllers';	
			$this->nameView = $module;
		}  else {
			$this->viewDir = 'modules' . DS . ucfirst($module) . DS . 'views';	
			$this->viewController  = 'starter' . DS . 'controllers';	
			$this->nameView = $nameView;
		}
	
		/*$this->nameView = ucfirst($this->nameView);

		$projectDir . $this->viewDir;*/
		
		$path = $projectDir . $this->viewDir;

		return $path;
	}

	/* 
		Verificar se já existe o modulo
	*/
	protected function hasModule()
	{
		$this->path = $this->project . DS . 'modules'. DS . $this->module . DS;

		return is_dir($this->path);
	}

	/* 
		Criar os diretorios
	 */	
	protected function mkdirModule($path)
	{

		mkdir($path . DS . $this->nameView);
	}

	/* 
		Criar o index do modulo
	 */
	protected function createIndexModule()
	{
		$file = $this->path . ucfirst($this->module) .'.php';

		$handle = fopen($file, 'w');

		$string = $this->handleContentIndex();

		fwrite($handle, $string);
	}

	/*
		Manipula o conteúdo do index modulo
	*/
	protected function handleContentIndex()
	{
		$file = $this->templateDir . DS .'Module.tpl';

		$content = fopen($file, 'r');

		$code = fread($content, filesize($file));

		$code = str_replace('{{projectName}}', $this->project, $code);

		$code = str_replace('{{moduleName}}',  $this->module, $code);

		fclose($content);

		return $code;
	}

	/*
		Define o caminho de template dos arquivos
	*/
	protected function setTemplateDir()
	{
		$this->templateDir =  __DIR__ . DS . 'Templates';
	}

}
