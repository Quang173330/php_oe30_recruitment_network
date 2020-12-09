<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tag;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $skills = $user->tags()->where('type', config('user.skill'))->get();
        $skillsNotBelongTo = Tag::where('type', config('user.skill'))->get()->diff($skills);
        $langs = $user->tags()->where('type', config('user.language'))->get();
        $langsNotBelongTo = Tag::where('type', config('user.language'))->get()->diff($langs);
        $workingTimes = $user->tags()->where('type', config('user.working_time'))->get();
        $workingTimesNotBelongTo = Tag::where('type', config('user.working_time'))->get()->diff($workingTimes);
        return view('edit_user',[
            'user' => $user,
            'skills' => $skills,
            'skillsNotBelongTo' => $skillsNotBelongTo,
            'langs' => $langs,
            'langsNotBelongTo' => $langsNotBelongTo,
            'workingTimes' => $workingTimes,
            'workingTimesNotBelongTo' => $workingTimesNotBelongTo,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if(isset($user)){
            $user->update($request->all());
            $user->tags()->sync($request->tag);
            $user->company()->update([
                'name' => $request->name_company,
                'address' => $request->address,
                'introduce' => $request->introduce_company,
                'website' => $request->link_website,
            ]);
            echo $user;
            echo $user->company;
        } else {

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
