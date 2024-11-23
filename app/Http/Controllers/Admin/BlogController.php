<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\CategoryBlog;
use App\Uploads\Images;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class BlogController extends Controller
{

    private $blogs, $categories;

    function __construct(Blog $blog, CategoryBlog $category)
    {
        $this->blogs = $blog;
        $this->categories = $category;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.blog.index', [
            'page_title' => 'Blog',
            'url_create' => route('admin.blog.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
    */
    public function getdata()
    {
        $data = $this->blogs->query();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $action = '';
                $action .= '<center><a href="' . route('admin.blog.edit', $data->id) . '" class="btn btn-sm btn-dark"><i class="fa fa-edit"></i></a>';
                $action .= ' ';
                $action .= '<button type="button" class="btn btn-sm btn-danger delete-item" data-url="' . route('admin.blog.destroy', $data->id) . '"><i class="fa fa-trash"></i></button></center>';

                return $action;
            })
            ->editColumn('category_blog_id', function ($data) {
                return $data->category->name ?? '<span class="badge badge-danger">NONE</span>';
            })
            ->editColumn('created_at', function ($data) {
                if($data->created_at == null){
                    return 'No Data';
                }
                return Carbon::parse($data->created_at)->diffForHumans();
            })
            ->rawColumns(['action', 'parent_id'])->make(true);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = null;
        return view('admin.pages.blog.form', [
            'page_title' => 'Create Blog',
            'data' => $data,
            'category' => $this->categories->get(),
            'url_create' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $image = null;
            $imageData = $request->file('image');

            if ($imageData != ' ') {
                $image = Images::uploadImageToStorage($imageData);
            }

            $formdata = [
                'slug' => Str::slug($request->title),
                'title' => $request->title,
                'description' => $request->description,
                'category_blog_id' => $request->category_blog_id,
                'sequence_post' => $request->secquence_post,
                'image' => $image,
            ];

            $this->blogs->create($formdata);

            DB::commit();
            return $this->success('Data successfully saved!', 'admin.blog.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error('Found error :' . ' ' . $th->getMessage());
        } catch (\Exception $th) {
            DB::rollBack();
            return $this->error('Found error :' . ' ' . $th->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->blogs->whereId($id)->first();
        return view('admin.pages.blog.form', [
            'page_title' => 'Edit Blog',
            'category' => $this->categories->get(),
            'data' => $data,
            'url_create' => null
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();

        try {
            $image = $this->blogs->find($id)->image;
            $imageData = $request->file('image');

            if ($imageData != ' ') {
                $image = Images::uploadImageToStorage($imageData);
            }

            $formdata = [
                'slug' => Str::slug($request->title),
                'title' => $request->title,
                'description' => $request->description,
                'category_blog_id' => $request->category_blog_id,
                'sequence_post' => $request->secquence_post,
                'image' => $image,
            ];

            $this->blogs->whereId($id)->update($formdata);

            DB::commit();
            return $this->success('Data successfully saved!', 'admin.blog.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error('Found error :' . ' ' . $th->getMessage());
        } catch (\Exception $th) {
            DB::rollBack();
            return $this->error('Found error :' . ' ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->blogs->whereId($id)->delete();
            return response()->json([
                'message' => 'Data deleted successfully !'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Found error :' . ' ' . $th->getMessage()
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Found error :' . ' ' . $th->getMessage()
            ]);
        }
    }
}
