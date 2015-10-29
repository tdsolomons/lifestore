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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->home();
	}


	public function seller()
	{
		$this->load->view('login');
	}


	public function home(){
		$data['title'] = 'Home';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/search_box');
		$this->load->view('imageBanner');

		$this->load->model('search_model');
		$this->load->model('profile_model');

		$data['categories'] = $this->search_model->getAllCategories();
		$data['latestItemsByFollowingSellers'] = $this->profile_model->getLatestItemsOfFollowingSellers();
		
		$this->load->model('Trending_model');
		$data['others_viewed'] = $this->Trending_model->others_viewed_items();
		$data['trending_items'] = $this->Trending_model->get_trending_items();
		$this->load->view('home_view', $data);
		$this->load->view('templates/footer');
	}

}
