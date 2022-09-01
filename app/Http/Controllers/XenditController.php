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
        $file = $request->file;
        $nama = $request->name.'.'.$request->extensi;
        $file->move('storage/', $nama);
	}
}