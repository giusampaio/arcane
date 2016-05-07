<?php

namespace Worknova\Starter\Controller;

use Arcane\Layers\Controller;
use Worknova\Starter\Model\Config;

class Config extends Controller
{

    /**
     * Model Config instance 
     * 
     * @var Worknova\Starter\Model\Config
     */
    private $model;

    /**
     * 
     */
    public function __construct()
    {
        $this->model = new Config();
    }

	/**
     * Render the table with all Configs
     * 
     * @return html
     */
    public function index()
    {
        $view = $this->view('index');
            
        $configs = $this->model->all();

        return $view->render(['config' => $configs]);
    }

    /**
     * Render the page for show Config data
     * 
     * @param  int $id 
     * @return html
     */
    public function show()
    {
        $view = $this->view('show');
        
        $id = $this->get('id');

        $config = $this->model->find($id);

        return $view->render($config); 
    }

	/**
     * Render the form to create a new Config
     * 
     * @return html
     */
    public function create()
    {
        $view = $this->view('form');

        if ( $this->post()->exists() ) {
            return $this->save();
        }

        return $view->render();    
    }

    /**
     * Render the form to edit a specified Config
     * 
     * @param  int $id Config id
     * @return html
     */
    public function edit()
    {
        $view = $this->view('form');

        $id = $this->get()->item('id');

        if ( $this->post()->exists() ) {
            return $this->save($id);
        }

        $config = $this->model->find($id);

        return $view->render($config);    
    }

    /**
     * Auxiliar function to validate data
     * 
     * @return boolean
     */
    protected function validate() 
    {
        return true;
    }

    /**
     * Validate and create a new Config on database
     * 
     * @return boolean
     */
    protected function save($id = null)
    {   
        if ( ! $this->validate() ) {
            return $this->router()->back();
        }

        $post = $this->post()->item('config');

        $config = ($id == null) ? $this->model : $this->model->find($id);
        
            
        $config->save();

        return $this->router()->go('/index');
    }	

    /**
     * Function to delete a Config
     * 
     * @param  int $id Config id
     * @return boolean
     */
    protected function delete($id)
    {
        //
        $config = $this->model->find($id);

        return $config->delete();
    }
}