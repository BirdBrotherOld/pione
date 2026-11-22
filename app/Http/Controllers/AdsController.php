<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DataTables;
use App\Models\Ads;
use App\Http\Requests\AdsRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Ads::where('user_id', auth()->user()->id)->with(['user'])->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($item){
                    $actionBtn = '
                    <div class="btn-group">
                        <a href="'. route('ads.edit', $item->id). '" class="btn btn-success btn-sm mr-3" title="Edit">
                            <span class="bi bi-pencil"></span>
                        </a>
                        <form action="'. route('ads.destroy', $item->id) .'" method="POST">
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

        return view('pages.ads.index');
    }

    public function indexAdmin(){
        if (request()->ajax()) {
            $data = Ads::with(['user'])->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($item){
                    $actionBtn = '
                    <div class="btn-group">
                        <a href="'. route('ads.edit', $item->id). '" class="btn btn-success btn-sm mr-3" title="Edit">
                            <span class="bi bi-pencil"></span>
                        </a>
                        <a href="'. route('ads.status', $item->id).'" class="btn btn-primary btn-sm mr-3" onclick="return confirm('.'Apakah Anda Yakin?'.')"><span class="bi bi-eye"></span></a>
                        <form action="'. route('ads.destroy', $item->id) .'" method="POST">
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

        return view('pages.ads.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdsRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $media = Storage::disk('s3')->put('images', $request->media);
        $data['media'] = Storage::disk('s3')->url($media);
        if (auth()->user()->roles == 'Admin' || auth()->user()->roles == 'SuperAdmin') {
            $data['status'] = 'Active';
        } else {
            $data['status'] = 'Pending';
        }

        Ads::create($data);

        Session::flash('success', "Ads Successfully Added!");
        return redirect()->route('ads.index');
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
        $ads = Ads::findOrFail($id);
        return view('pages.ads.edit', [
            'ads' => $ads,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdsRequest $request, $id)
    {
        $data = $request->all();
        $ads = Ads::findOrFail($id);

        if ($request->media == null) {
            $data['media'] = $ads->media;
        } else {
            $media = Storage::disk('s3')->put('images', $request->media);
            $data['media'] = Storage::disk('s3')->url($media);
        }
        $ads->update($data);

        Session::flash('success', "Ads Successfully Updated!");
        return redirect()->route('ads.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ads = Ads::findOrFail($id);

        $ads->delete();
        return redirect()->route('ads.index');
    }

    public function changeStatusActive($id)
    {
        $ads = Ads::findOrFail($id);
        $ads->status = 'Active';

        $ads->save();

        Session::flash('success', 'Status Iklan sudah diupdate');
        return redirect()->back();
    }
}
