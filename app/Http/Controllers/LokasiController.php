<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('lokasi.index');
    }

    public function data()
    {
        $lokasi = Lokasi::orderBy('id_lokasi', 'desc')->get();

        return datatables()
            ->of($lokasi)
            ->addIndexColumn()
            ->addColumn('aksi', function ($lokasi) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('lokasi.update', $lokasi->id_lokasi) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button onclick="deleteData(`'. route('lokasi.destroy', $lokasi->id_lokasi) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lokasi = new Lokasi();
        $lokasi->nama_lokasi = $request->nama_lokasi;
        $lokasi->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lokasi = Lokasi::find($id);

        return response()->json($lokasi);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lokasi = Lokasi::find($id);
        $lokasi->nama_lokasi = $request->nama_lokasi;
        $lokasi->update();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lokasi = Lokasi::find($id);
        $lokasi->delete();

        return response(null, 204);
    }
}
