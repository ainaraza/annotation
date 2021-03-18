<?php
namespace App\Models;

use CodeIgniter\Model;

class PsiTypesModel extends Model{
	protected $table = 'psi_types';
	protected $primaryKey = 'id';

	protected $returnType = 'array';
}