<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Product::where('user_id', auth()->user()->id)->with(['user']);

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $actionBtn = '<div class="btn-group">
                    <a href="' . route('product.edit', $item->slug) . '" class="btn btn-success btn-sm">
                        <span class="bi bi-pencil"></span>
                    </a>
                    <form action="' . route('product.delete', $item->id) . '" method="POST">
                    ' . method_field('delete') . csrf_field() . '
                        <button type="submit" class="btn btn-danger btn-sm">
                            <span class="bi bi-trash"></span>
                        </button>
                    </form>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // $product = Product::all();
        // $product->with('user');
        // return view('pages.product.index', [
        //     'product' => $product,
        // ]);

        return view('pages.product.index');
    }

    public function get()
    {
        $category = Product::all();
        return response($category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['user_id'] = auth()->user()->id;
        $path = Storage::disk('s3')->put('images', $request->path);
        $data['path'] = Storage::disk('s3')->url($path);
        $data['size'] = $request->path->getSize();
        Product::create($data);

        Session::flash('success', "Product Successfully Added!");
        return redirect()->route('product.index');
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
        $product = Product::where('slug', $id)->where('user_id', auth()->user()->id)->firstOrFail();

        return view('pages.product.edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $product = Product::findOrFail($id);

        $data['slug'] = Str::slug($request->name);
        $data['user_id'] = auth()->user()->id;
        if ($request->file('path') == null) {
            $data['path'] = $product->path;
        } else {
            $path = Storage::disk('s3')->put('images', $request->path);
            $data['path'] = Storage::disk('s3')->url($path);
            $data['size'] = $request->path->getSize();
        }
        $product->update($data);

        Session::flash('success', "Product Successfully Updated!");
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();
        return redirect()->route('product.index');
    }
}
