<?php

namespace App\Http\Controllers\API;
use App\Http\Resources\Tag as TagResource;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') <= 50?$request->input('limit'):15;
        $user = TagResource::collection( Tag::paginate());
        return $user->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Tag::class);
        $user= new TagResource( Tag::create($request->all()));
        return $user->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user =new TagResource( Tag::findOrFail($id));
        return $user->response()->setStatusCode(200,"User Returned Successfully")
        ->header('Additional Header' , 'True');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $idtag = Tag::findOrFail($id);
        $this->authorize('update',$idtag);
        $user=new TagResource(Tag::findOrFail($id));
        $user->update($request->all());

        return $user->response()->setStatusCode(200,"User updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idtag = Tag::findOrFail($id);
        $this->authorize('delete',$idtag);
        Tag::findOrFail($id)->delete();
  
        return 204;
    }
}
