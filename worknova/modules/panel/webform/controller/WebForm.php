<?php

namespace Worknova\Panel\WebForm\Controller;

use Arcane\Layers\Controller;
use Worknova\Panel\WebForm\Model\WebForm;

class WebForm extends Controller
{

    /**
     * Model WebForm instance 
     * 
     * @var Worknova\Panel\WebForm\Model\WebForm
     */
    private $model;

    /**
     * 
     */
    public function __construct()
    {
        $this->model = new WebForm();
    }

	/**
     * Render the table with all WebForms
     * 
     * @return html
     */
    public function index()
    {
        $view = $this->view('index');
            
        $webforms = $this->model->all();

        return $view->render(['webform' => $webforms]);
    }

    /**
     * Render the page for show WebForm data
     * 
     * @param  int $id 
     * @return html
     */
    public function show()
    {
        $view = $this->view('show');
        
        $id = $this->get('id');

        $webform = $this->model->find($id);

        return $view->render($webform); 
    }

	/**
     * Render the form to create a new WebForm
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
     * Render the form to edit a specified WebForm
     * 
     * @param  int $id WebForm id
     * @return html
     */
    public function edit()
    {
        $view = $this->view('form');

        $id = $this->get()->item('id');

        if ( $this->post()->exists() ) {
            return $this->save($id);
        }

        $webform = $this->model->find($id);

        return $view->render($webform);    
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
     * Validate and create a new WebForm on database
     * 
     * @return boolean
     */
    protected function save($id = null)
    {   
        if ( ! $this->validate() ) {
            return $this->router()->back();
        }

        $post = $this->post()->item('webform');

        $webform = ($id == null) ? $this->model : $this->model->find($id);
        
            
        $webform->save();

        return $this->router()->go('/index');
    }	

    /**
     * Function to delete a WebForm
     * 
     * @param  int $id WebForm id
     * @return boolean
     */
    protected function delete($id)
    {
        //
        $webform = $this->model->find($id);

        return $webform->delete();
    }
}