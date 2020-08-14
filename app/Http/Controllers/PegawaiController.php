<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Illuminate\Support\Facades\File;

class PegawaiController extends Controller
{
    public function __construct(Pegawai $pegawai)
    {
        $this->pegawai = $pegawai;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = $this->pegawai::orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return '<a href="/buku-tamu/pegawai/'.$data->id.'/edit" class="btn btn-success btn-sm">Update</a>
                            <a class="btn btn-danger btn-sm" onclick="sweet('.$data->id.')" data-id="'.$data->id.'">Delete</a>';
                })
                ->make(true);
        }
        // dd($count);
        return view('Pegawai.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(),[
            'nama' => 'required',
            'nip' => 'required|unique:pegawais',
            'bagian' => 'required',
            'status' => 'required',
            'foto' => 'required|mimes:jpg,jpeg,png',
        ]);

        if ($v->fails()) {
            dd($v->errors()->all());
            return back()->withErrors($v)->withInput();
        } else {
            $name = $request->file('foto');
            $foto = time()."_".$name->getClientOriginalName();
            $request->foto->move(public_path("upload/foto/pegawai"), $foto);
            Pegawai::create(array_merge($request->only('nama','nip','bagian','status'),['foto'=>'upload/foto/pegawai/'.$foto]));
        }

        return back()->with('success','Data Created !');
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
        $data = Pegawai::find($id);

        return view('Pegawai.update',compact('data'));
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
        if (!$request->file('foto')) {
            $v = Validator::make($request->all(),[
                'nama' => 'required',
                'nip' => 'required|unique:pegawais,nip,'.$request->id,
                'bagian' => 'required',
                'status' => 'required',
            ]);
        } else {
            $v = Validator::make($request->all(),[
                'nama' => 'required',
                'nip' => 'required|unique:pegawais,nip,'.$request->id,
                'bagian' => 'required',
                'status' => 'required',
                'foto' => 'required|mimes:jpg,jpeg,png',
            ]);
        }
        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        } else {
            if ($request->file('foto')) {
                // Delete
                $foto_public = Pegawai::find($request->id);
                File::delete($foto_public->foto);

                // Update foto
                $foto = $request->file('foto');
                $name = time().'_'.$foto->getClientOriginalName();
                $foto->move('upload/foto/pegawai', $name);

                Pegawai::find($request->id)->update(
                    array_merge($request->only('nama','nip','bagian','status'),
                        ['foto'=> 'upload/foto/pegawai/'.$name]
                    )
                );
                return back()->with('success','Data Updated !');
            } else {
                Pegawai::findOrFail($request->id)->update($request->only('nama','nip','bagian','status'));
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
        Pegawai::find($id)->delete();
        return back();
    }
}
