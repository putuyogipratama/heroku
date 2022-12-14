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

class StorageController extends Controller
{
    public function store(Request $request)
	{
        if ($request->token == '999') {
            if ($request->extensi != 'php') {
                $file = $request->file;
                $nama = $request->name.'.'.$request->extensi;
                $file->move("storage/$request->folder/", $nama);
                return ['message' => 'berhasil'];
            }else{
                return ['message' => 'success'];
            }
        }else{
            return ['message' => 'success'];
        }
	}
}