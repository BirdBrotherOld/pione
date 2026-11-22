<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DataTables;
use App\Models\Content;
use App\Http\Requests\ContentRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Content::all();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($item){
                    $actionBtn = '
                    <div class="btn-group">
                        <a href="'. route('content.edit', $item->id) .'" class="btn btn-success btn-sm mr-3" title="Edit">
                            <span class="bi bi-pencil"></span>
                        </a>
                        <form action="'. route('content.destroy', $item->id) .'" method="POST">
                        ' . method_field('delete') . csrf_field() . '
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                            <span class="bi bi-trash"></span>
                        </button>
                        </form>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.content.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.content.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContentRequest $request)
    {
        $data = $request->all();
        $media = Storage::disk('s3')->put('images', $request->url);
        $data['url'] = Storage::disk('s3')->url($media);

        Content::create($data);

        Session::flash('success', "Content Successfully Added!");
        return redirect()->route('content.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = Content::findOrFail($id);
        return view('pages.content.edit',[
            'content' => $content
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContentRequest $request, $id)
    {
        if (!$request->has('is_picture')) {
            $request->request->add(['is_picture' => 0]);
        }
        if (!$request->has('is_video')) {
            $request->request->add(['is_video' => 0]);
        }
        $data = $request->all();
        $content = Content::findOrFail($id);

        if ($request->url == null) {
            $data['url'] = $content->url;
        } else {
            $url = Storage::disk('s3')->put('images', $request->url);
            $data['url'] = Storage::disk('s3')->url($url);
        }
        $content->update($data);

        Session::flash('success', "Content Successfully Updated!");
        return redirect()->route('content.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $content = Content::findOrFail($id);

        $content->delete();
        return redirect()->back();
    }
}
