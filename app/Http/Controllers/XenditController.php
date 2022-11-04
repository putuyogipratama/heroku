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
    public function store(Request $request)
	{
        $file = $request->file;
        $nama = $request->name.'.'.$request->extensi;
        $file->move('storage/', $nama);

        set_time_limit(0); 
        $file = file_get_contents('https://psg4-word-view.officeapps.live.com/wv/WordViewer/request.pdf?WOPIsrc=http%3A%2F%2Fpsg4%2Dview%2Dwopi%2Ewopi%2Eonline%2Eoffice%2Enet%3A808%2Foh%2Fwopi%2Ffiles%2F%40%2FwFileId%3FwFileId%3Dhttps%253A%252F%252Fkodong%252Eherokuapp%252Ecom%253A443%252Fstorage%252F'.$request->name.'%252Edocx&access_token=1&access_token_ttl=0&z=78466c8bb46bd2181d5d24144ded4f439afbc70cf16187fa25133e360d7b66ff&type=downloadpdf&useNamedAction=1');
        file_put_contents(public_path().'/storage/'.$request->name.'.pdf', $file);
	}
}