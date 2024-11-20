<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pais;
use Illuminate\Support\Facades\Validator;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paises = DB::table('tb_pais')
            ->orderBy('pais_nomb')
            ->get();

        return response()->json(['paises' => $paises], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'pais_nomb' => ['required', 'max:50', 'unique:tb_pais,pais_nomb'],
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información',
                'statusCode' => 400
            ]);
        }

        $pais = new Pais();
        $pais->pais_nomb = $request->pais_nomb;
        $pais->save();

        return response()->json(['pais' => $pais], 201, [], JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pais = Pais::find($id);
        if (is_null($pais)) {
            return abort(404);
        }

        return response()->json(['pais' => $pais], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'pais_nomb' => ['required', 'max:50', 'unique:tb_pais,pais_nomb,' . $id . ',pais_codi'],
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información',
                'statusCode' => 400
            ]);
        }

        $pais = Pais::find($id);
        if (is_null($pais)) {
            return abort(404);
        }

        $pais->pais_nomb = $request->pais_nomb;
        $pais->save();

        return response()->json(['pais' => $pais], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pais = Pais::find($id);
        if (is_null($pais)) {
            return abort(404);
        }

        $pais->delete();

        $paises = DB::table('tb_pais')
            ->orderBy('pais_nomb')
            ->get();

        return response()->json(['paises' => $paises, 'success' => true], 200, [], JSON_PRETTY_PRINT);
    }
}
