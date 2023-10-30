<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::where('nama_kategori', 'Spare Part')->orWhere('nama_kategori', 'Ban')->pluck('nama_kategori', 'id_kategori');
        return view('barang.index', compact('kategori'));
    }

    public function data()
    {
        $produk = Barang::with('kategori')->get();
     
        return datatables()
            ->of($produk)
            ->addIndexColumn()
            ->addColumn('select_all', function ($produk) {
                return '
                    <input type="checkbox" name="id_produk[]" value="'. $produk->id_barang .'">
                ';
            })
            ->addColumn('kode_produk', function ($produk) {
                return '<span class="label label-success">'. $produk->kode_barang .'</span>';
            })
            ->addColumn('nama_kategori', function ($produk) {
                return $produk->kategori->nama_kategori;
            })
            ->addColumn('harga', function ($produk) {
                return format_uang($produk->harga);
            })
            ->addColumn('stok', function ($produk) {
                return format_uang($produk->stok);
            })
            ->addColumn('aksi', function ($produk) {
                    return '
                    <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('barang.update', $produk->id_barang) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    </div>
                    ';

                }
            )
            ->rawColumns(['aksi', 'kode_produk', 'select_all'])
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
        $produk = Barang::orderBy('kode_barang', 'DESC')->latest()->first() ?? new Barang();
        $id_barang = $produk->id_barang + 1;
        $request['kode_barang'] = 'P'. tambah_nol_didepan((int)$produk->id_barang +1, 6);

        if($request->id_kategori == 1){
            $produk = Barang::create($request->all());
            return response()->json('Data berhasil disimpan', 200);
        }else{
            session(['produk' => $request->all(), 'id_barang' => $id_barang]);
            return response()->json('Data berhasil disimpan', 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produk = Barang::find($id);

        return response()->json($produk);
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
        $produk = Barang::find($id);
        $produk->update($request->all());
        
        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
