<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $take = $request->query('take', 10); // default 10 data
        $skip = $request->query('skip', 0); // default 0 data
        $search = $request->query('search');

        if ($search) {
            $produk = Produk::where('nama', 'like', '%' . $search . '%')
                ->take($take)
                ->skip($skip)
                ->get();
        } else {
            $produk = Produk::take($take)->skip($skip)->get();
        }
        return response()->json(
            [
                'code' => '200',
                'status' => 'success',
                'data' => $produk
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required'
        ]);
        //store data to database
        $produk = Produk::create($request->all());
        return response()->json(
            [
                'code' => '201',
                'status' => 'success',
                'data' => $produk
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        // get data by id
        return response()->json(
            [
                'code' => '200',
                'status' => 'success',
                'data' => $produk
            ],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        // validate request
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required'
        ]);
        //update data produk by id
        $produk->update($request->all());
        return response()->json(
            [
                'code' => '200',
                'status' => 'success',
                'data' => $produk
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        // delete data produk by id
        $produk->delete();
        return response()->json(
            [
                'code' => '200',
                'status' => 'success',
                'data' => $produk
            ],
            200
        );
    }
}
