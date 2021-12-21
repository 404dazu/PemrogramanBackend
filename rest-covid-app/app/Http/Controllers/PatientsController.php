<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use App\Models\Status;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Nullable;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //tampilan-
        $patients = Patients::latest()->get();
        $total = count($patients);

        if($total){
            $data = [
                'pesan' => 'Data telah ditampilkan',
                'total pasien' => $total,
                'data pasien' => $patients
            ];
            return response()->json($data,200);
        }
        $data = [
            'pesan' => 'Tidak ada Data',
        ];
        return response()->json($data,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Menambah data
        $validasi = $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'alamat' => 'required',
            'status_id' => 'required',
            'tanggal_masuk' => 'required',
        ]);

        $patients = Patients::create($validasi);

        $data = [
            'pesan' => 'Data telah ditambahkan!',
            'data pasien' => $patients
        ];
        return response()->json($data,201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Tampilan data
        $patients = Patients::find($id);
        $patients->status_id = $patients->status->name;
        if($patients){
            $data = [
                'pesan' => 'Data dengan id: ' . $id . ' telah ditemukan!',
                'data pasien' => $patients
            ];
            return response()->json($data,200);
        }
        $data = [
            'pesan' => 'Data dengan id: ' . $id . ' tidak ditemukan!'
        ];
        return response()->json($data,404);
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
        //Mengedit data
        $patients = Patients::find($id);
        
        if($patients){
            $patients->update($request->all());
            $data = [
                'pesan' => 'Data dengan id: ' . $id . ' telah diubah!',
                'data pasien' => $patients
            ];
            return response()->json($data,200);
        }
        $data = [
            'pesan' => 'Data dengan id: ' . $id . ' tidak ditemukan!'
        ];
        return response()->json($data,404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Menghapus data
        $patients = Patients::find($id);
        
        if($patients){
            $patients->delete();
            $data = [
                'pesan' => 'Data dengan id: ' . $id . ' telah dihapus!',
                'data pasien' => $patients
            ];
            return response()->json($data,200);
        }
        $data = [
            'pesan' => 'Data dengan id: ' . $id . ' tidak ditemukan!'
        ];
        return response()->json($data,404);
    }
    public function search($name){
        $patients = Patients::where('name','like','%'.$name.'%')->get();
        $total = count($patients);

        if($total){
            $data = [
                'pesan' => 'Nama telah ditemukan',
                'total pasien' => $total,
                'data pasien' => $patients
            ];
            return response()->json($data,200);
        }
        $data = [
            'pesan' => 'Tidak ada Nama di Data',
        ];
        return response()->json($data,404);
    }
    public function statuses($request){
        if($request == 'positive'){
            $patients = Patients::where('status_id', '=', 1)->get();
            $total = count($patients);

            $data = [
                'pesan' => 'Pasien dengan status: ' . $request . ' telah ditampilkan',
                'total pasien' => $total,
                'data pasien' => $patients
           ];
            return response()->json($data,200);
            
        }else if($request == 'recovered'){
            $patients = Patients::where('status_id', '=', 2)->get();
            $total = count($patients);
        
            $data = [
                'pesan' => 'Pasien dengan status: ' . $request . ' telah ditampilkan',
                'total pasien' => $total,
                'data pasien' => $patients
           ];
            return response()->json($data,200);
        }else if($request == 'dead'){
            $patients = Patients::where('status_id', '=', 3)->get();
            $total = count($patients);
        
            $data = [
                'pesan' => 'Pasien dengan status: ' . $request . ' telah ditampilkan',
                'total pasien' => $total,
                'data pasien' => $patients
           ];
            return response()->json($data,200);
        }else{
            $data = [
                'pesan' => 'Pasien tidak ditampilkan',
           ];
           return response()->json($data,404);
        }
    }
}