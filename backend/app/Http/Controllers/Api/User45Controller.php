<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Res;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class User45Controller extends Controller
{
    public function index()
    {
        $user = User::all()->where('role', '==', 'user');
        return new Res(true, 'Get success', $user);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        if ($user->detail_data != null) {
            $user['detail_data'] = $user->detail_data;
            $user['agama'] = $user->detail_data->agama;
        }
        return new Res(true, 'Get success', $user);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return new Res(true, 'Delete success', null);
    }

    public function update($id)
    {
        $user = User::findOrFail($id);
        $user->is_aktif = true;
        $user->save();

        return new Res(true, 'Approve success', null);
    }

    public function editimage(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'required'
        ]);

        if ($validator->fails()) {
            return new Res(false, 'Validation failed', null);
        }

        $user = User::findOrFail($id);
        $user->foto = $request->foto;
        $user->save();

        if ($user) {
            return new Res(true, 'Update success', null);
        }
        return new Res(false, 'Update failed', null);
    }

    public function editpassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return new Res(false, 'Validation failed', null);
        }

        $user = User::findOrFail($id);
        $user->password = bcrypt($request->password);
        $user->save();

        if ($user) {
            return new Res(true, 'Update success', null);
        }
        return new Res(false, 'Update failed', null);
    }
}
