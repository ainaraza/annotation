<?php 
namespace App\Entities;

use CodeIgniter\Entity;
use CodeIgniter\Database\Exceptions\DatabaseException;

class Tweet extends Entity{
	private $psi_table = 'tweets_annotation_psi';
	private $types_table = 'tweets_annotation_types';

	public function addTypes($types){
		$data = [];

		foreach($types as $type){
			$data []= [
				'tweet' => $this->id,
				'type' => $type,
				'user' => 0
			];
		}

		try {
			$db = \Config\Database::connect();
			if(! empty($data))
				$db->table($this->types_table)->insertBatch($data);
		} catch (DatabaseException $e) {
			throw new \Exception("Error Processing Request", 1);
		}
	}

	public function addPsi($psi){
		$psi = $psi ? 1 : 0;
		
		$data = [
			'tweet' => $this->id,
			'psi' => $psi,
			'user' => 0
		];

		try{
			$db = \Config\Database::connect();
			$db->table($this->psi_table)->insert($data);
		} catch(DatabaseException $e){
			throw new \Exception("Error Processing Request", 1);
		}
	}
}