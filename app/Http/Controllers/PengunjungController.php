<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengunjung;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Carbon\Carbon;
use PDF;
use App\Models\AktivitasPengunjung;
use App\Models\antri;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

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
            $tanggal = Carbon::now();
            $pengunjung = Pengunjung::create(array_merge($request->only('nama','nik','instansi','telp','tujuan','jk','kunjungan'),['tanggal'=>$tanggal]));

        //    if ($pengunjung->id) {
            // AktivitasPengunjung::create([
            //     'jadwal' => $tanggal,
            //     'id_pengunjung' => $pengunjung->id,
            // ]);

            return back()->with('success','Data Created !');
            // } else {
            // return back()->with('failed','Data Null !');
        //    }
        }

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
            $data = Pengunjung::findOrFail($id)->update($request->only('nama','nik','instansi','telp','tujuan','kunjungan','jk'));
            // dd($data);
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

    public function laporan(Request $req)
    {
        set_time_limit(99999);
        $v = Validator::make($req->all(), [
            'awal' => 'required|date',
            'akhir' => 'required|date',
        ]);
        $awal = $req->awal;
        $akhir = $req->akhir;

        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        }
        if ($awal > $akhir) {
             return back()->with('failed','Tanggal Awal Dilarang Melampaui Tanggal Akhir');
        }

        $data = Pengunjung::whereBetween('tanggal',[$req->awal, $req->akhir])->latest()->get();
        if ($data->isEmpty()) {
            return back()->with('failed','Data Null !');
        } else {
            $pdf = PDF::loadview('Pengunjung.laporan_pdf',['data'=>$data, 'awal'=>$awal, 'akhir'=>$akhir]);
            set_time_limit(300);
            return $pdf->stream('Monitoring-Report-'.$req->akhir);
            return view('Pengunjung.laporan_pdf',['data'=>$data,'awal'=>$awal, 'akhir'=>$akhir]);
        }
    }
    public function antri(Request $request)
    {
        $tanggal = Carbon::now()->format('Y-m-d');
        // dd($tanggal);
        $today = antri::where('tanggal',$tanggal)->get();
        // dd($today);
        if ($today) {
            // antri::create([
            //     'no_antri' => '1'
            // ]);

            $pengunjung = Pengunjung::first();
            $max = $today->max('no_antri');
            $no_antri = $max + 1;
            // dd($no_antri);
            $create = antri::create([
                'no_antri' => $no_antri,
                'tanggal' => $tanggal,
                'id_pengunjung' => $pengunjung->id,
            ]);
        } else {
            echo "kosong";
        }

        if($request->ajax()){
            try {
                $ip = '192.168.1.8'; // IP Komputer kita atau printer lain yang masih satu jaringan
                $printer = 'EPSON TM-U220 Receipt'; // Nama Printer yang di sharing
                    $connector = new WindowsPrintConnector("smb://" . $ip . "/" . $printer);
                    $printer = new Printer($connector);
                    $printer -> text("Email :" . $request->email . "\n");
                    $printer -> text("Username:" . $request->username . "\n");
                    $printer -> cut();
                    $printer -> close();
                    $response = ['success'=>'true'];
            } catch (\Exception $e) {
                    $response = ['success'=>'false'];
            }
            return response()
                ->json($response);
        }
        return back();
        // $max= antri::where('tanggal',$tanggal)->where('no_antri')->get()->max();
        // dd($max);
        // return view('Pengunjung.antri',compact('data'));
    }

}
