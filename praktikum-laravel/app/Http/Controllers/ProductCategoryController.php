<?php

namespace App\Http\Controllers;


use App\Http\Requests\ProductCategoryCollection;
use App\Http\Requests\ProductCategoryResource;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequestroductCategoryRequest;
use App\Http\Resources\ProductCategoryCollection as ResourcesProductCategoryCollection;
use App\Http\Resources\ProductCategoryResource as ResourcesProductCategoryResource;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $queryData = ProductCategory::all();
            $formattedDatas = new ResourcesProductCategoryCollection($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request)
    {
        $validatedRequest = $request->validated();
        try {
            $queryData = ProductCategory::create($validatedRequest);
            $formattedDatas = new ResourcesProductCategoryResource($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $queryData = ProductCategory::findOrFail($id);
            $formattedDatas =  new ResourcesProductCategoryResource($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        } catch (Exception $e) {
            return response()->jon($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCategoryRequest $request, string $id)
    {
        $validatedRequest = $request->validated();
        try {
            $queryData = Productcategory::findOrFail($id);
            $queryData->update($validatedRequest);
            $queryData->save();
            $formattedDatas = new ResourcesProductCategoryResource($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas

            ], 200);
        } catch (Exception $e) {
            return response()->jon($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $queryData = Productcategory::findOrFail($id);
            $queryData->delete();
            $formattedDatas = new ResourcesProductCategoryResource($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas

            ], 200);
        } catch (Exception $e) {
            return response()->jon($e->getMessage(), 400);
        }
    }
}
