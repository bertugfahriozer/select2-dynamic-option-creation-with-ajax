<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message',['categories'=>$this->commonModel->lists([],'categories')]);
	}

	public function add_category()
	{
		if($this->input->is_ajax_request() && $this->input->method()=='post'){
			if($this->commonModel->isHave('categories',['categoryName'=>$this->input->post('categoryName')])===0 && $this->commonModel->isHave('categories',['id'=>$this->input->post('categoryName')])===0){
				$newID=$this->commonModel->create('categories',['categoryName'=>$this->input->post('categoryName')]);
				if($newID)
					$this->output
						->set_content_type('application/json')
						->set_output(json_encode(array('result' => true,'new'=>$this->commonModel->selectOne(['id'=>$newID],'categories'))));
			}
			else
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode(array('result' => false)));
		}
	}

	public function create_stuff()
	{
		if($this->input->method()=='post'){
			print_r($_POST);
		}
	}
}
