<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Corrupter;
use Illuminate\Http\Request;
use Inertia\Inertia;
use File;
use Illuminate\Support\Facades\Storage;
use Redirect;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Profil';
        $query = Profile::with('corrupter');
        if(request('search')){
            $query->where('nama', 'LIKE', '%'.request('search').'%');
        }
        return Inertia::render('profile/index', [
            'title' => $title,
            'profiles' => $query->latest()->paginate(10),
        ]);
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

    public function addCase($id){
        $title = 'Kasus Korupsi';
        return Inertia::render('koruptor/create', [
            'title' => $title,
            'profile' => Profile::find($id),
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $img1 = $request->image;
       
        if ($request->file('image')) {
            $img1 = $request->image->getClientOriginalName();
            $request->image->storeAS('images/profile/', $img1);
            }
        $profiles = Profile::create([
            'nama' => $request->nama,
            'image' => $img1,
            'tgl_lahir' => $request->tgl_lahir,
            'agama' => $request->agama,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);
        return Redirect::route('profile.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $title = 'Edit Profile';
        return Inertia::render('profile/edit', [
            'profile' => $profile,
            'title' => $title,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profile = Profile::find($id);
        $img1 = $profile->image;
        if ($request->file('image')) {
            File::delete(public_path('storage/images/profile/'.$profile->image));
               $img1 = $request->image->getClientOriginalName();
                $request->image->storeAs('images/profile', $img1);
            }
            $profile->update([
                'nama' => $request->nama,
                'image' => $img1,
                'tgl_lahir' => $request->tgl_lahir,
                'agama' => $request->agama,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);
        return Redirect::route('profile.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = Profile::find($id);
        if (!empty($profile->image)) {
            File::delete(public_path('storage/images/profile/'.$profile->image));
        }
        $profile->delete();
        return Redirect::route('profile.index');
    }
}
