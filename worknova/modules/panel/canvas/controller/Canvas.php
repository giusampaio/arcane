<?php

namespace Worknova\Panel\Canvas\Controller;

use Arcane\Layers\Controller;
use Worknova\Panel\Canvas\Model\Canvas;

class Canvas extends Controller
{

    /**
     * Model Canvas instance 
     * 
     * @var Worknova\Panel\Canvas\Model\Canvas
     */
    private $model;

    /**
     * 
     */
    public function __construct()
    {
        $this->model = new Canvas();
    }

	/**
     * Render the table with all Canvass
     * 
     * @return html
     */
    public function index()
    {
        $view = $this->view('index');
            
        $canvass = $this->model->all();

        return $view->render(['canvas' => $canvass]);
    }

    /**
     * Render the page for show Canvas data
     * 
     * @param  int $id 
     * @return html
     */
    public function show()
    {
        $view = $this->view('show');
        
        $id = $this->get()->segment(4);

        $canvas = $this->model->find($id);

        $attr = $this->placeholders('canvas', $canvas);

        return $view->render($attr); 
    }

        /**
     * Prepare the placeholder object to send to the Show View
     * 
     * @param  string $index 
     * @param  object $obj   
     * @return array
     */
    public function placeholders($index, $obj)
    {
        $tmp = $obj->getAttributes();

        foreach ($tmp as $key => $value) {
            $attr[] = ['key' => $key, 'value' => $value];
        }

        $placeholder[$index] = $obj;
        $placeholder['attr'] = $attr;

        return $placeholder;
    }

	/**
     * Render the form to create a new Canvas
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
     * Render the form to edit a specified Canvas
     * 
     * @param  int $id Canvas id
     * @return html
     */
    public function edit()
    {
        $view = $this->view('form');

        $id = $this->get()->segment(4);

        if ( $this->post()->exists() ) {
            return $this->save($id);
        }

        $canvas = $this->model->find($id);

        return $view->render($canvas);    
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
     * Validate and create a new Canvas on database
     * 
     * @return boolean
     */
    protected function save($id = null)
    {   
        if ( ! $this->validate() ) {
            return $this->router()->back();
        }

        $post = $this->post()->item('canvas');

        $canvas = ($id == null) ? $this->model : $this->model->find($id);
        
        $canvas->id    = $post['id'];
        $canvas->teste = $post['teste'];
        $canvas->description = $post['description'];
            
        $canvas->save();

        return $this->router()->go('/index');
    }	

    /**
     * Function to delete a Canvas
     * 
     * @param  int $id Canvas id
     * @return boolean
     */
    protected function delete($id)
    {
        //
        $canvas = $this->model->find($id);

        return $canvas->delete();
    }
}