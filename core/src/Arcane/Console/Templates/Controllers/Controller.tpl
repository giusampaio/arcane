<?php

namespace {{namespace}};

use Arcane\Layers\Controller;
use {{namespaceModel}};

class {{controllerName}} extends Controller
{

    /**
     * Model {{controllerName}} instance 
     * 
     * @var {{namespaceModel}}
     */
    private $model;

    /**
     * 
     */
    public function __construct()
    {
        $this->model = new {{controllerName}}();
    }

	/**
     * Render the table with all {{controllerName}}s
     * 
     * @return html
     */
    public function index()
    {
        $view = $this->view('index');
            
        ${{varController}}s = $this->model->all();

        return $view->render(['{{varController}}' => ${{varController}}s]);
    }

    /**
     * Render the page for show {{controllerName}} data
     * 
     * @param  int $id 
     * @return html
     */
    public function show()
    {
        $view = $this->view('show');
        
        $id = $this->get('id');

        ${{varController}} = $this->model->find($id);

        return $view->render(${{varController}}); 
    }

	/**
     * Render the form to create a new {{controllerName}}
     * 
     * @return html
     */
    public function create()
    {
        $view = $this->view('form');

        if ( $this->post()->exists() ) {
            return $this->save($id);
        }

        return $view->render();    
    }

    /**
     * Render the form to edit a specified {{controllerName}}
     * 
     * @param  int $id {{controllerName}} id
     * @return html
     */
    public function edit()
    {
        $view = $this->view('form');

        $id = $this->get('id');

        if ( $this->post()->exists() ) {
            return $this->save($id);
        }

        ${{varController}} = $this->model->find($id);

        return $view->render(${{varController}});    
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
     * Validate and create a new {{controllerName}} on database
     * 
     * @return boolean
     */
    protected function save($id)
    {   
        if ( ! $this->validate() ) {
            return $this->router()->back();
        }

        $post = $this->post('{{varController}}');

        ${{varController}} = $this->model->find($id);

        {{saveController}}
        ${{varController}}->save();

        return $this->router()->go('/index');
    }	

    /**
     * Function to delete a {{controllerName}}
     * 
     * @param  int $id {{controllerName}} id
     * @return boolean
     */
    protected function delete($id)
    {
        //
        ${{varController}} = $this->model->find($id);

        return ${{varController}}->delete();
    }
}