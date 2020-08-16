<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SetLaporan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class SetlapController extends Controller
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
        $data = SetLaporan::findOrFail($id);

        return view('SetLaporan.index',compact('data'));
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
        if (!$request->file('icon')) {
            $v = Validator::make($request->all(),[
                'header' => 'required',
                'footer' => 'required',
            ]);
        } else {
            $v = Validator::make($request->all(),[
                'header' => 'required',
                'footer' => 'required',
                'icon' => 'required|mimes:jpg,jpeg,png',
            ]);
        }
        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        } else {
            if ($request->file('icon')) {
                // Delete
                $foto_public = SetLaporan::find($request->id);
                File::delete($foto_public->foto);

                // Update foto
                $foto = $request->file('icon');
                $name = time().'_'.$foto->getClientOriginalName();
                $foto->move('upload/foto/Laporan', $name);

                SetLaporan::find($request->id)->update(
                    array_merge($request->only('header','footer'),
                        ['icon'=> 'upload/foto/Laporan/'.$name]
                    )
                );
                return back()->with('success','Data Updated !');
            } else {
                SetLaporan::findOrFail($request->id)->update($request->only('header','footer'));
                return back()->with('success','Data Updated !');
            }
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
