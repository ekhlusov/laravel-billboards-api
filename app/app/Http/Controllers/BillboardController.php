<?php

namespace App\Http\Controllers;

use App\Billboard;
use Illuminate\Http\Request;
use App\Http\Resources\Billboard as BillboardResource;
use App\Http\Resources\Billboards as BillboardsResource;

class BillboardController extends Controller
{
    public function index()
    {
        return new BillboardsResource(Billboard::all());
    }

    public function show(Billboard $billboard)
    {
        BillboardResource::withoutWrapping();
        return new BillboardResource($billboard);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $billboard = Billboard::create($input);

        return response()->json($billboard, 201);
    }

    public function update(Request $request, Billboard $billboard)
    {
        $input = $request->all();
        $billboard->update($input);

        return response()->json($billboard, 200);
    }

    public function delete(Billboard $billboard)
    {
        $billboard->delete();

        return response()->json(null, 204);
    }
}
