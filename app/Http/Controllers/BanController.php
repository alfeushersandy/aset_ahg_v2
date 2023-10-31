<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailBan;
use Illuminate\Http\Request;

class BanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $items = [$request->all('ban')];
        foreach ($items[0]['ban'] as $value) {

            $ban = DetailBan::create([
                'id_barang' => session('id_barang'),
                'nomor_seri' => $value["'nomor_seri'"],
                'stamp_ban' => $value["'stamp_ban'"],
                'no_po' => $value["'no_po'"],
                'tgl_datang' => $value["'tgl_datang'"]
            ]);
        }

        $produk = Barang::create([
            'kode_barang' => session("produk.kode_barang"),
            'nama_barang' => session("produk.nama_barang"),
            'id_kategori' => session("produk.id_kategori"),
            'satuan' => session("produk.satuan"),
            'merk' => session("produk.merk"),
            'harga' => session("produk.harga"),
            'stok' => session("produk.stok"),

        ]);

        $request->session()->forget(['produk', 'id_barang']);
        return redirect()->route('barang.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
