<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Http\Resources\CityCollection;
use App\Models\City;
use App\Repositories\CityRepository;
use Exception;
use Illuminate\Http\Response;

class CityController extends Controller
{
    protected $model;

    /**
     * Set the model
     *
     * CityController constructor.
     * @param City $city
     */
    public function __construct(City $city)
    {
        $this->model = new CityRepository($city);
    }

    /**
     * Display a listing of the resource.
     * @param CityRequest $request
     * @return CityCollection|City
     */
    public function index(CityRequest $request)
    {
        $search = $request->validated();

        if (count($search) === 0) {
            return response()->json($this->model->all(), 201);
        }

        return response()->json($this->model->search($search), 201);
    }

    /**
     * Store a newly created resource in storage.
     * @param CityRequest $request
     * @return City
     */
    public function store(CityRequest $request)
    {
        return response()->json($this->model->create($request->validated()), 201);
    }

    /**
     * Display the specified resource.
     * @param City $city
     * @return City
     */
    public function show(City $city)
    {
        return response()->json($this->model->show($city), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CityRequest $request
     * @param int $id
     * @return Response
     */
    public function update(CityRequest $request, int $id)
    {
        if (!$this->model->isExistRecord($id)) {
            response()->json(null, 400);
        }

        return response()->json($this->model->update($request->validated(), $id), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function destroy(int $id)
    {
        if (!$this->model->isExistRecord($id)) {
            response()->json(null, 400);
        }

        return response($this->model->delete($id), 204);
    }
}
