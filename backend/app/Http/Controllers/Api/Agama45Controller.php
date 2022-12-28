<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Res;
use App\Models\Agama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Agama45Controller extends Controller
{
    public function index()
    {
        $agama = Agama::all();
        return new Res(true, 'Get success', $agama);
    }

    public function show($id)
    {
        $agama = Agama::findOrFail($id);
        return new Res(true, 'Get success', $agama);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_agama' => 'required|unique:agamas,nama_agama',
        ]);

        if ($validator->fails()) {
            return new Res(false, 'Validation failed', $validator->errors());
        }

        $agama = Agama::create([
            'nama_agama' => $request->nama_agama,
        ]);

        if ($agama) {
            return new Res(true, 'Create success', $agama);
        }

        return new Res(false, 'Create failed', null);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_agama' => 'required|unique:agamas,nama_agama'
        ]);

        if ($validator->fails()) {
            return new Res(false, 'Validation failed', $validator->errors());
        }

        $agama = Agama::findOrFail($id);
        $agama->nama_agama = $request->nama_agama;
        $agama->save();

        if ($agama) {
            return new Res(true, 'Update success', $agama);
        }

        return new Res(false, 'Update failed', null);
    }

    public function destroy($id)
    {
        $agama = Agama::findOrFail($id);

        if ($agama) {
            $agama->delete();
            return new Res(true, 'Delete success', null);
        }
        return new Res(false, 'Delete failed', null);
    }
}
