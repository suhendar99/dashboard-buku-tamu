<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengunjung;
use Illuminate\Support\Facades\Validator;
use DataTables;

class PengunjungController extends Controller
{
    public function __construct(Pengunjung $pengunjung)
    {
        $this->pengunjung = $pengunjung;
    }
    /**
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = $this->pengunjung::orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return '<a href="/buku-tamu/pengunjungBackend/'.$data->id.'/edit" class="btn btn-success btn-sm">Update</a>
                            <a class="btn btn-danger btn-sm" onclick="sweet('.$data->id.')" data-id="'.$data->id.'">Delete</a>';
                })
                ->make(true);
        }
        // dd($count);
        return view('Pengunjung.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Pengunjung.create');
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
            'nik' => 'required|unique:pengunjungs',
            'instansi' => 'required',
            'telp' => 'required|numeric',
            'tujuan' => 'required',
            'kunjungan' => 'required',
        ]);

        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        } else {
            Pengunjung::create($request->all());
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
        $pengunjung = Pengunjung::findOrFail($id);

        return view('Pengunjung.update',compact('pengunjung'));
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
        $v = Validator::make($request->all(),[
            'nama' => 'required',
            'nik' => 'required|unique:pengunjungs,nik,'.$id,
            'instansi' => 'required',
            'telp' => 'required|numeric',
            'tujuan' => 'required',
            'kunjungan' => 'required',
        ]);

        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        } else {
            Pengunjung::findOrFail($id)->update($request->all());
        }

        return back()->with('success','Data Updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pengunjung::findOrFail($id)->delete();

        return back();
    }
}
