<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Tag;
use App\Image;
use App\Company;
class EmployerUpdateProfile extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function uploadProfile()
    {
        $skills = Tag::where('type', config('user.skill'))->get();
        $langs = Tag::where('type', config('user.language'))->get();
        $workingTimes = Tag::where('type', config('user.working_time'))->get();
        return view('upload_profile', [
            'skills' => $skills,
            'langs' => $langs,
            'workingTimes' => $workingTimes,
        ]);
    }

    public function upload(Request $request)
    {
        $cv = $request->cv;
        $avt = $request->avatar;
        $tag = $request->tag;
        $avt_com = $request->avatar_company;
        if(isset($cv)){
            $url_cv=$cv->move(public_path()."/upload/user",$cv->getClientOriginalName().date("Y-m-d h:i:sa"));
        }
        if(isset($avt)){
            $url_avt=$avt->move(public_path()."/upload/user",$avt->getClientOriginalName().date("Y-m-d h:i:sa"));
        }
        if(isset($avt_com)){
            $url_avt_com=$avt_com->move(public_path()."/upload/company",$avt_com->getClientOriginalName().date("Y-m-d h:i:sa"));
        }
        $user = Auth::user();
        $user->cv=$url_cv;
        $user->tags()->attach($tag);
        $user->save();
        Image::create([
            'url' => $url_avt,
            'imageable_id' => $user->id,
            'imageable_type' => User::class,
            'type' => '3',
        ]);
        $company = $user->company;
        Image::create([
            'url' => $url_avt_com,
            'imageable_id' => $company->id,
            'imageable_type' => Company::class,
            'type' => '2',
        ]);
        echo $user->image;

    }
}
