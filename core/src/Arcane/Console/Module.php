<?php 

namespace Arcane\Console;

use Arcane\Console\Project;

class Module
{
	/*
		Nome do projeto
	 */
	private $project; 

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
		$this->splitDefinitions($definition);

		if (! Project::hasProject($this->project)) {
			return 'Project not found';
		}

		if ($this->hasModule()) {
			return 'Cannot redeclare module on the project';
		}		

		$this->setTemplateDir();

		$this->mkdirModule();

		$this->createIndexModule();

		return true;
	}

	/* 
		Separar as definições
	 */
	protected function splitDefinitions($definition)
	{
		$pieces = explode('.', $definition);

		$this->project = (isset($pieces[0])) ? $pieces[0] : null;

		$this->module = (isset($pieces[1])) ? $pieces[1] : null;
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
	protected function mkdirModule()
	{
		$dirs = ['models', 'views', 'controllers', 'assets'];
		
		mkdir($this->path);

		foreach ($dirs as $dir) {
			mkdir($this->path  . $dir);
		}
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