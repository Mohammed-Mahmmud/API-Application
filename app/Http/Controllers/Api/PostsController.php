<?php

namespace App\Http\Controllers\Api;

use App\Api\PostsTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Posts\PostStoreRequest;
use App\Http\Resources\Api\PostsResource;
use App\Models\Api\Posts;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use PostsTrait;
    public function index()
    {
        $data = PostsResource::collection(Posts::get());
        return $this->apiResponse($data,200,'ok');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'desc' => 'required',
        ]);
        if ($validator->fails()) {
             return $this->apiResponse(null, 400, $validator->errors()->first());
        }

        $data = Posts::create($request->all());
        if(!empty($data)){
            return $this->apiResponse(new PostsResource($data),201,'data has been saved');
        }
        return $this->apiResponse($data,400,'data not saved');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data =Posts::Find($id);
        if(!empty($data)){
            return $this->apiResponse(new PostsResource($data),200,'data has been shown');
        }
        return $this->apiResponse($data,404,'data not found');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'desc' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, 400, $validator->errors()->first());
        }
        $data= Posts::Find($id);
        if(!empty($data)){
        $data->update($request->all());
            return $this->apiResponse(new PostsResource($data),201,'data has been updated');
        }
        return $this->apiResponse($data,400,'data not found');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Posts::Find($id);
        if(!empty($data)){
            $data->delete();
            return $this->apiResponse(new PostsResource($data),200,'data has been deleted');
        }
        return $this->apiResponse($data,404,'data not found');
    }
}
