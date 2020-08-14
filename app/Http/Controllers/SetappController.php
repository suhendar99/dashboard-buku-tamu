<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SetApp;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class SetappController extends Controller
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
        $data = SetApp::findOrFail($id);

        return view('Setapp.index',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->file('icon_tab')) {
            $v = Validator::make($request->all(),[
                'name_tab' => 'required',
                'name_app' => 'required',
                'icon_app' => 'required',
                'copyright' => 'required',
            ]);
        } else {
            $v = Validator::make($request->all(),[
                'name_tab' => 'required',
                'name_app' => 'required',
                'icon_app' => 'required',
                'copyright' => 'required',
                'icon_tab' => 'required|mimes:jpg,jpeg,png',
            ]);
        }
        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        } else {
            if ($request->file('icon_tab')) {
                // Delete
                $foto_public = SetApp::find($request->id);
                File::delete($foto_public->foto);

                // Update foto
                $foto = $request->file('icon_tab');
                $name = time().'_'.$foto->getClientOriginalName();
                $foto->move('upload/foto/App', $name);

                SetApp::find($request->id)->update(
                    array_merge($request->only('name_tab','name_app','icon_app','copyright'),
                        ['icon_tab'=> 'upload/foto/App/'.$name]
                    )
                );
                return back()->with('success','Data Updated !');
            } else {
                SetApp::findOrFail($request->id)->update($request->only('name_tab','name_app','icon_app','copyright'));
                return back()->with('success','Data Updated !');
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
