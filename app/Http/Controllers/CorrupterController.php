<?php

namespace App\Http\Controllers;

use App\Models\Corrupter;
use App\Models\Profile;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Redirect;
class CorrupterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Koruptor';
        $query = Corrupter::with('profile');
        if(request('search')){
            $query->where('uang', 'LIKE', '%'.request('search').'%');
        }
        return Inertia::render('koruptor/index', [
            'title' => $title,
            'korupters' => $query->latest()->paginate(10),
            
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profiles = Corrupter::create([
            'profile_id' => $request->profile_id,
            'case_date' => $request->case_date,
            'jabatan' => $request->jabatan,
            'partai' => $request->partai,
            'kasus' => $request->kasus,
            'uang' => $request->uang,
            'hukuman' => $request->hukuman,
        ]);
        return Redirect::route('koruptor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Corrupter  $corrupter
     * @return \Illuminate\Http\Response
     */
    public function show(Corrupter $corrupter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Corrupter  $corrupter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $corrupter = Corrupter::with('profile')->find($id);
        $title = 'Edit koruptor';
        return Inertia::render('koruptor/edit', [
            'corrupter' => $corrupter,
            'title' => $title,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Corrupter  $corrupter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $corrupter = Corrupter::find($id);
        $corrupter->update([
            'profile_id' => $request->profile_id,
            'case_date' => $request->case_date,
            'jabatan' => $request->jabatan,
            'partai' => $request->partai,
            'kasus' => $request->kasus,
            'uang' => $request->uang,
            'hukuman' => $request->hukuman,
        ]);
        return Redirect::route('koruptor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Corrupter  $corrupter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Corrupter $corrupter)
    {
        //
    }
}
