<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Auth;

class XenditController extends Controller
{
    public function xendit(Request $request)
	{
// 		$xenditXCallbackToken = '77D1iUKljMpgr0qbWqT1gf4PcPuNiQYdIuwSuFaX0AmCg1EY';
		$xenditXCallbackToken = 'EXGdfQC6LFVpKD9dKeeJ4fJnBJIQk3sgN0VAGEMIcyu3AkKC';
		$reqHeaders = getallheaders();
		$xIncomingCallbackTokenHeader = isset($reqHeaders['X-CALLBACK-TOKEN']) ? $reqHeaders['X-CALLBACK-TOKEN'] : "";
		if($xIncomingCallbackTokenHeader === $xenditXCallbackToken){
			$rawRequestInput = file_get_contents("php://input");
			$data = json_decode($rawRequestInput, true);
				$arr = [
					'external_id' => $data['external_id'],
					'id' => $data['id'],
					'user_id' => $data['user_id'],
					'is_high' => $data['is_high'],
					'payment_method' => $data['payment_method'],
					'status' => $data['status'],
					'merchant_name' => $data['merchant_name'],
					'amount' => $data['amount'],
					'paid_amount' => $data['paid_amount'],
					'paid_at' => $data['paid_at'],
					'description' => $data['description'],
					'payment_channel' => $data['payment_channel'],
					'currency' => $data['currency'],
					'updated' => $data['updated'],
					'created' => $data['created'],
				];

				$curl = curl_init();
				curl_setopt_array($curl, array(
				CURLOPT_URL => 'https://nara.pocketnihongo.id/api/getData',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => $data,
				));
				$response = curl_exec($curl);
				curl_close($curl);
				
				$curl = curl_init();
				curl_setopt_array($curl, array(
				CURLOPT_URL => 'https://staging-nara.pocketnihongo.id/api/getData',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => $data,
				));
				$response = curl_exec($curl);
				curl_close($curl);

				return response()->json($data);
		}else{
			http_response_code(403);
		}
	}
}