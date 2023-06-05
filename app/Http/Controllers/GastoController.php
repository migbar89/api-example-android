<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GastoController extends Controller
{
	public function GetAll()
	{
		try {

			$data = DB::table('gastos')
				->select('gastos.id as id', 'gastos.Name as name', 'gastos.Date as date', 'gastos.Amount as amount',
					'gastos.State as state')->get();

			return response(['status' => "ok", 'data' => $data, 'message' => '', 'error' => false], 200)
				->header('Content-Type', 'text/plain');
		} catch (Exception $exception) {
			return response(['status' => "error", 'data' => [], 'error' => true, 'message' => $exception->getMessage()], 400)
				->header('Content-Type', 'text/plain');
		}

	}

	public function Save(Request $request)
	{
		try {
			$data = $request->all();
			$response = DB::table('gastos')->insertGetId([
				"Name"=>$data['name'],
				"Date"=>$data['date'],
				"Amount"=>$data['amount'],
				"State"=>$data['state'],
			]);
			return response(['status' => "ok", 'data' => $response, 'message' => '', 'error' => false], 200)
				->header('Content-Type', 'text/plain');
		} catch (Exception $exception) {
			return response(['status' => "error", 'data' => 0, 'error' => true, 'message' => $exception->getMessage()], 400)
				->header('Content-Type', 'text/plain');

		}
	}
	//
}
