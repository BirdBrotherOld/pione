<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventEditRequest;
use App\Http\Requests\EventRequest;
use App\Models\Chapter;
use App\Models\Event;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Event::with(['chapter'])->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $actionBtn = '
                    <div class="btn-group">
                        <a href="' . route('event.edit', $item->slug) . '" class="btn btn-success btn-sm mr-3" title="Edit">
                            <span class="bi bi-pencil"></span>
                        </a>
                        <a href="#" class="btn btn-primary btn-sm mr-3" title="Detail">
                            <span class="bi bi-eye"></span>
                        </a>
                        <form action="' . route('event.delete', $item->slug) . '" method="POST">
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

        return view('pages.event.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chapters = Chapter::all();
        return view('pages.event.create', [
            'chapters' => $chapters,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $photos = Storage::disk('s3')->put('images', $request->photos);
        $data['photos'] = Storage::disk('s3')->url($photos);

        Event::create($data);

        Session::flash('success', "Event Successfully Added!");
        return redirect()->route('event.index');
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
        $chapters = Chapter::all();
        $event = Event::where('slug', $id)->firstOrFail();

        return view('pages.event.edit', [
            'event' => $event,
            'chapters' => $chapters,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventEditRequest $request, $id)
    {
        $data = $request->all();
        $event = Event::where('slug', $id)->firstOrFail();

        if ($request->photos == null) {
            $data['photos'] = $event->photos;
        } else {
            $photos = Storage::disk('s3')->put('images', $request->photos);
            $data['photos'] = Storage::disk('s3')->url($photos);
        }
        $event->update($data);

        Session::flash('success', "Event Successfully Updated!");
        return redirect()->route('event.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::where('slug', $id)->firstOrFail();

        $event->delete();
        return redirect()->route('event.index');
    }
}
