<?php

namespace Worknova\Site\Opportunity\Controller;

use Arcane\Layers\Controller;
use Worknova\Site\Opportunity\Model\Opportunity;

class Opportunity extends Controller
{

    /**
     * Model Opportunity instance 
     * 
     * @var Worknova\Site\Opportunity\Model\Opportunity
     */
    private $model;

    /**
     * 
     */
    public function __construct()
    {
        $this->model = new Opportunity();
    }

	/**
     * Render the table with all Opportunitys
     * 
     * @return html
     */
    public function index()
    {
        $view = $this->view('index');
            
        $opportunitys = $this->model->all();

        return $view->render(['opportunity' => $opportunitys]);
    }

    /**
     * Render the page for show Opportunity data
     * 
     * @param  int $id 
     * @return html
     */
    public function show()
    {
        $view = $this->view('show');
        
        $id = $this->get('id');

        $opportunity = $this->model->find($id);

        return $view->render($opportunity); 
    }

	/**
     * Render the form to create a new Opportunity
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
     * Render the form to edit a specified Opportunity
     * 
     * @param  int $id Opportunity id
     * @return html
     */
    public function edit()
    {
        $view = $this->view('form');

        $id = $this->get()->item('id');

        if ( $this->post()->exists() ) {
            return $this->save($id);
        }

        $opportunity = $this->model->find($id);

        return $view->render($opportunity);    
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
     * Validate and create a new Opportunity on database
     * 
     * @return boolean
     */
    protected function save($id = null)
    {   
        if ( ! $this->validate() ) {
            return $this->router()->back();
        }

        $post = $this->post()->item('opportunity');

        $opportunity = ($id == null) ? $this->model : $this->model->find($id);
        
        $opportunity->title = $post['title'];
        $opportunity->type = $post['type'];
        $opportunity->description = $post['description'];
        $opportunity->dt_create = $post['dt_create'];
        $opportunity->dt_update = $post['dt_update'];
        $opportunity->active = $post['active'];
        $opportunity->ban = $post['ban'];
            
        $opportunity->save();

        return $this->router()->go('/index');
    }	

    /**
     * Function to delete a Opportunity
     * 
     * @param  int $id Opportunity id
     * @return boolean
     */
    protected function delete($id)
    {
        //
        $opportunity = $this->model->find($id);

        return $opportunity->delete();
    }
}