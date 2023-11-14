<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiBaseController;
use App\Jobs\CreateProductJob;
// use App\Mail\WelcomeMail;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $rows = Product::all();

        // Test mail + job
        CreateProductJob::dispatch();
        // dispatch(function () {
        //     Mail::to('testuer@qeoqeo.com')->send(new WelcomeMail());
        // });

        return $this->returnSuccess($rows);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sku' => 'required',
            'name' => 'required'
        ]);
        $validated = $validator->validated();
        $newRow = Product::create($validated);
        return $this->returnSuccess($newRow);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $row = Product::find($id);
        if (empty($row)) {
            return $this->returnFail('Row is not found');
        }
        return $this->returnSuccess($row);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $row = Product::find($id);
        if (empty($row)) {
            return $this->returnFail('Row is not found');
        }
        $validator = Validator::make($request->all(), [
            'sku' => '',
            'name' => ''
        ]);
        $validated = $validator->validated();
        $updateRow = $row->update($validated);
        return $this->returnSuccess($updateRow);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $row = Product::find($id);
        if (empty($row)) {
            return $this->returnFail('Row is not found');
        }
        $row->delete();
        return $this->returnSuccess('Action completed');
    }
}
