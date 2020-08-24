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
        // $sekarang = Carbon::now();
        $now = date('Y-m-d');
        $pengunjung_sekarang = Pengunjung::where('tanggal',$now)->get()->count();
        $pengunjung_now = AktivitasPengunjung::where('jadwal',$now)->get();
        $kunjung_now = $pengunjung_now->count();

        $senin = Carbon::now()->startOfWeek();
        $selasa = $senin->copy()->addDays();
        $rabu = $selasa->copy()->addDays();
        $kamis = $rabu->copy()->addDays();
        $jumat = $kamis->copy()->addDays();
        $sabtu = $jumat->copy()->addDays();
        $minggu = $sabtu->copy()->addDays();
        $data_senin = AktivitasPengunjung::where('jadwal',$senin)->get()->count();
        $data_selasa = AktivitasPengunjung::where('jadwal',$selasa)->get()->count();
        $data_rabu = AktivitasPengunjung::where('jadwal',$rabu)->get()->count();
        $data_kamis = AktivitasPengunjung::where('jadwal',$kamis)->get()->count();
        $data_jumat = AktivitasPengunjung::where('jadwal',$jumat)->get()->count();
        $data_sabtu = AktivitasPengunjung::where('jadwal',$sabtu)->get()->count();
        $data_minggu = AktivitasPengunjung::where('jadwal',$minggu)->get()->count();
        $data = [];
        array_push($data, $data_senin);
        array_push($data, $data_selasa);
        array_push($data, $data_rabu);
        array_push($data, $data_kamis);
        array_push($data, $data_jumat);
        array_push($data, $data_sabtu);
        array_push($data, $data_minggu);
        // $hari = AktivitasPengunjung::where('jadwal',[$date,$now])->count();

        $jk1 = Pengunjung::where('jk','L')->get()->count();
        $jk2 = Pengunjung::where('jk','P')->get()->count();
        return view('Dashboard.index',compact('jk1','jk2','data','kunjung_now','pengunjung_sekarang'));
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
