<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use App\Models\Pengunjung;
use App\Models\AktivitasPengunjung;

class DashboardController extends Controller
{
    public function __construct(AktivitasPengunjung $aktivitas)
    {
        $this->aktivitas = $aktivitas;
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $data = $this->aktivitas::with('pengunjung')->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        $now = date('Y-m-d');
        $pengunjung_now = AktivitasPengunjung::where('jadwal',$now)->get();
        $kunjung_now = $pengunjung_now->count();
        // dd($kunjung_now);
        // $hari = AktivitasPengunjung::where('jadwal',[$date,$now])->count();

        $jk1 = Pengunjung::where('jk','L')->get()->count();
        $jk2 = Pengunjung::where('jk','P')->get()->count();
        return view('Dashboard.index',compact('jk1','jk2','kunjung_now'));
    }

    public function store(Request $request)
    {
        $tanggal = now();
        $pengunjung = Pengunjung::where('nik',123123)->first(); //ubah
        // dd($pengunjung);
        if ($pengunjung != null) {
            AktivitasPengunjung::create([
                'jadwal' => $tanggal,
                'id_pengunjung' => $pengunjung->id,
            ]);
        } else {
            return back()->with('failed','Pengunjung Belum Terdaftar !');
        }

        return back();
    }
}
