<?php

namespace Worknova\Panel\Address\Controller;

use Arcane\Layers\Controller;
use Worknova\Panel\Address\Model\Address;

class Address extends Controller
{

    /**
     * Model Address instance 
     * 
     * @var Worknova\Panel\Address\Model\Address
     */
    private $model;

    /**
     * 
     */
    public function __construct()
    {
        $this->model = new Address();
    }

	/**
     * Render the table with all Addresss
     * 
     * @return html
     */
    public function index()
    {
        $view = $this->view('index');
            
        $addresss = $this->model->all();

        return $view->render(['address' => $addresss]);
    }

    /**
     * Render the page for show Address data
     * 
     * @param  int $id 
     * @return html
     */
    public function show()
    {
        $view = $this->view('show');
        
        $id = $this->get('id');

        $address = $this->model->find($id);

        return $view->render($address); 
    }

	/**
     * Render the form to create a new Address
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
     * Render the form to edit a specified Address
     * 
     * @param  int $id Address id
     * @return html
     */
    public function edit()
    {
        $view = $this->view('form');

        $id = $this->get()->item('id');

        if ( $this->post()->exists() ) {
            return $this->save($id);
        }

        $address = $this->model->find($id);

        return $view->render($address);    
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
     * Validate and create a new Address on database
     * 
     * @return boolean
     */
    protected function save($id = null)
    {   
        if ( ! $this->validate() ) {
            return $this->router()->back();
        }

        $post = $this->post()->item('address');

        $address = ($id == null) ? $this->model : $this->model->find($id);
        
        $address->id = $post['id'];
        $address->address = $post['address'];
        $address->city = $post['city'];
        $address->state = $post['state'];
        $address->neighborhood = $post['neighborhood'];
        $address->postalcode = $post['postalcode'];
        $address->longitude = $post['longitude'];
        $address->latitude = $post['latitude'];
            
        $address->save();

        return $this->router()->go('/index');
    }	

    /**
     * Function to delete a Address
     * 
     * @param  int $id Address id
     * @return boolean
     */
    protected function delete($id)
    {
        //
        $address = $this->model->find($id);

        return $address->delete();
    }
}