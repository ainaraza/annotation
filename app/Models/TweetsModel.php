<?php
namespace App\Models;

use CodeIgniter\Model;

class TweetsModel extends Model{
	protected $table = 'tweets';
	protected $primaryKey = 'id';	
	protected $returnType = 'App\Entities\Tweet';

	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

	protected $allowedFields = ['annotated', 'editing'];
}