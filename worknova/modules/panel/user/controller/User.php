<?php

namespace Worknova\Panel\User\Controller;

use Arcane\Layers\Controller;
use Worknova\Panel\User\Model\User;

class User extends Controller
{

    /**
     * Model User instance 
     * 
     * @var Worknova\Panel\User\Model\User
     */
    private $model;

    /**
     * 
     */
    public function __construct()
    {
        $this->model = new User();
    }

	/**
     * Render the table with all Users
     * 
     * @return html
     */
    public function index()
    {
        $view = $this->view('index');
            
        $users = $this->model->all();

        return $view->render(['user' => $users]);
    }

    /**
     * Render the page for show User data
     * 
     * @param  int $id 
     * @return html
     */
    public function show()
    {
        $view = $this->view('show');
        
        $id = $this->get()->segment(4);

        $user = $this->model->find($id);

        $attr = $this->placeholders('user', $user);

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
     * Render the form to create a new User
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
     * Render the form to edit a specified User
     * 
     * @param  int $id User id
     * @return html
     */
    public function edit()
    {
        $view = $this->view('form');

        $id = $this->get()->item('id');

        if ( $this->post()->exists() ) {
            return $this->save($id);
        }

        $user = $this->model->find($id);

        return $view->render($user);    
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
     * Validate and create a new User on database
     * 
     * @return boolean
     */
    protected function save($id = null)
    {   
        if ( ! $this->validate() ) {
            return $this->router()->back();
        }

        $post = $this->post()->item('user');

        $user = ($id == null) ? $this->model : $this->model->find($id);
        
        $user->id          = $post['id'];
        $user->firstname   = $post['firstname'];
        $user->lastname    = $post['lastname'];
        $user->password    = $post['password'];
        $user->facebook_id = $post['facebook_id'];
        $user->dob         = $post['dob'];
        $user->dt_create   = date('Y-m-d');
        $user->dt_update   = date('Y-m-d');
            
        $user->save();

        return $this->router()->go('/index');
    }	

    /**
     * Function to delete a User
     * 
     * @param  int $id User id
     * @return boolean
     */
    protected function delete($id)
    {
        //
        $user = $this->model->find($id);

        return $user->delete();
    }
}