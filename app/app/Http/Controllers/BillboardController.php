<?php

namespace App\Http\Controllers;

use App\Billboard;
use App\Jobs\ProcessCoordinates;
use Illuminate\Http\Request;
use App\Http\Resources\Billboard as BillboardResource;
use App\Http\Resources\Billboards as BillboardsResource;

class BillboardController extends Controller
{
    /**
     * @return \App\Http\Resources\Billboards
     */
    public function index()
    {
        return new BillboardsResource(Billboard::all());
    }

    /**
     * @param \App\Billboard $billboard
     *
     * @return \App\Http\Resources\Billboard
     */
    public function show(Billboard $billboard)
    {
        BillboardResource::withoutWrapping();
        return new BillboardResource($billboard);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $input = $request->all();
        $billboard = Billboard::create($input);
        $this->dispatchingJob($input, $billboard);

        return response()->json($billboard, 201);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Billboard           $billboard
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Billboard $billboard)
    {
        $input = $request->all();
        $billboard->update($input);
        $this->dispatchingJob($input, $billboard);


        return response()->json($billboard, 200);
    }

    /**
     * @param \App\Billboard $billboard
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Billboard $billboard)
    {
        $billboard->delete();

        return response()->json(null, 204);
    }

    /**
     * Склеивает город и адресс и размещает задание в очередь
     * @param                $request
     * @param \App\Billboard $billboard
     */
    private function dispatchingJob($request, Billboard $billboard)
    {
        $address = "{$request['city']}, {$request['address']}";
        ProcessCoordinates::dispatch($billboard, $address);
    }

}
