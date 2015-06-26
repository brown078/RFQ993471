<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FDARequest extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
        //TwOhEwWWk1eGlkFl8n1HHCn93bmJity6AZbQGHpj
        public function drugsearch($search)
        {
            //using fopen for no curl requirements, all FDA requests are get requests
            $data = file_get_contents("https://api.fda.gov/drug/event.json?api_key=TwOhEwWWk1eGlkFl8n1HHCn93bmJity6AZbQGHpj&patient.drug.openfda.pharm_class_epc:\"nonsteroidal+anti-inflammatory+drug\"&count=patient.reaction.reactionmeddrapt.exac");
            echo $data;
            
            
            
        }
        
        
}
