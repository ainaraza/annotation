<?php 
namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use \App\Models\TweetsModel;
use \App\Models\UsersModel;

class Ajax extends BaseController{
	use ResponseTrait;


	public function getTweet($class=0, $prp=0){
		$tweetsModel = new TweetsModel();


		$tweet = $tweetsModel->where('annotated', 0)
							 ->where('editing', 0);

		// if($class != 0){
		// 	$tweet = $tweet->where('class', $class);
		// }

		// if($prp != 0){
		// 	$tweet = $tweet->where('has_prp', $prp);
		// }

		$tweet = $tweet->where('class', 1);
		$tweet = $tweet->where('has_prp', 1);

		$tweet = $tweet->orderBy('id', 'DESC');
		$tweet = $tweet->first();
		// $tweet->editing = 1;
		// $tweetsModel->save($tweet);

		return $this->setResponseFormat('json')->respond($tweet, 200);
	}

	public function annotateTweet($id){
		// die();
		$json = $this->request->getJSON(true);

		$types = $json['types'];
		$psi = $json['psi'];

		$tweetsModel = new TweetsModel();

		try{
			$tweet = $tweetsModel->find($id);

			$tweet->addTypes($types);
			$tweet->addPsi($psi);

			$tweet->annotated = $tweet->annotated + 1;

			$tweet->editing = 0;

			$tweetsModel->save($tweet);
		}catch(\Exception $e){
			return $this->setResponseFormat('json')->fail(['error']);
		}

		return $this->setResponseFormat('json')->respond(['status'=> true], 200);
	}

	public function addUser(){
		$json = $this->request->getJSON(true);
		$username = $json['user'];

		$usersModel = new UsersModel();
		$usersModel->insert(['name' => $username]);
	}

	public function getUsers(){
		$usersModel = new UsersModel();
		$users = $usersModel->orderBy('name')->findAll();

		return $this->setResponseFormat('json')->respond($users);
	}
}