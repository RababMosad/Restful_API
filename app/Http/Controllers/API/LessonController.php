<?php

namespace App\Http\Controllers\API;
use App\Http\Resources\Lesson as LessonResource;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;


class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') <= 50?$request->input('limit'):15;
        $user = LessonResource::collection( Lesson::paginate($limit));
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
        $user= new LessonResource( Lesson::create($request->all()));
        return $user->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user =new LessonResource( Lesson::findOrFail($id));
        return $user->response()->setStatusCode(200,"User Returned Successfully")
        ->header('Additional Header' , 'True');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $idlesson = Lesson::findOrFail($id);
        $this->authorize('update',$idlesson);
        $user=new LessonResource(Lesson::findOrFail($id));
        $user->update($request->all());

        return $user->response()->setStatusCode(200,"User updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idlesson = Lesson::findOrFail($id);
        $this->authorize('delete',$idlesson);
        Lesson::findOrFail($id)->delete();
    
        return 204;
    }
}
