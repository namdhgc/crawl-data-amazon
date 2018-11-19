<?php

namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\Media as ModelMedia;
use Spr\Base\Controllers\Helper as HelperController;
// use Intervention\Image\Exception\NotReadableException;
use Hash;
use Input;
use Image;
use Config;
use File;
use Auth;
use Lang;
use Session;
use Cookie;

class LocaleController extends Controller
{

    protected $name_session_file_upload;
    protected $table = "media";

    public function __construct()
    {
    }

    public function setLocale () {

        $lang = input::get('lang');
        if($lang == null) $lang = 'vi';

        if(array_key_exists($lang, Config::get('languages'))) {

            Cookie::queue('applocale', $lang, 365 * 24 * 60 * 60);
        }
    }
}