<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FDARequest extends CI_Controller {

	/*
         * Index a standard message output unless there is a request
         * 
         * 
         * 
         */
	public function index()
	{
		$this->load->view('welcome_message');
	}
       
        public function drugsearch($search)
        {
                        error_reporting(0);// allow for JSON errors only
                        //if no search term immediatelly error
                        if($search)
                        {
                        $this->load->model('fda_model');
                        echo "callback(".$this->fda_model->search($search).");";
                        }
                        else
                        {
                            echo 'callback({"error": {"code": "NOT_FOUND","message": "You need to enter a search term"}});';
                        }
        }
        
        
}
