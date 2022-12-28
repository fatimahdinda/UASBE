<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Agama45Controller extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:8000/api/agama45/')->json();
        return view('agama.agama', [
            'response' => $response,
            'no' => 1,
            'page' => "Agama"
        ]);
    }

    public function store(Request $request)
    {

        Http::post('http://localhost:8000/api/agama45/', [
            'nama_agama' => $request->nama_agama,
        ]);

        return redirect('/agama45')->with('success', 'Create success');
    }

    public function update(Request $request, $id)
    {
        Http::put('http://localhost:8000/api/agama45/' . $id, [
            'nama_agama' => $request->nama_agama
        ]);

        return redirect('/agama45');
    }

    public function destroy($id)
    {
        Http::delete('http://localhost:8000/api/agama45/' . $id);

        return redirect('/agama45');
    }
}
