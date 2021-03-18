<?php namespace App\Controllers;

use \App\Models\PsiTypesModel;

class Home extends BaseController
{
	public function index()
	{
		$psiTypesModel = new PsiTypesModel();
		$data['psiTypes'] = $psiTypesModel->findAll();

		return view('home', $data);
	}

	
}
