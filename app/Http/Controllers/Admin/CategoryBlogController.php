<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryBlog;
use App\Uploads\Images;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CategoryBlogController extends Controller
{

    private $categories;

    function __construct(CategoryBlog $category)
    {
        $this->categories = $category;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.category.index', [
            'page_title' => 'Category',
            'url_create' => route('admin.category.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
    */
    public function getdata()
    {
        $data = $this->categories->query();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $action = '';
                $action .= '<center><a href="' . route('admin.category.edit', $data->id) . '" class="btn btn-sm btn-dark"><i class="fa fa-edit"></i></a>';
                $action .= ' ';
                $action .= '<button type="button" class="btn btn-sm btn-danger delete-item" data-url="' . route('admin.category.destroy', $data->id) . '"><i class="fa fa-trash"></i></button></center>';

                return $action;
            })
            ->editColumn('parent_id', function ($data) {
                return $data->category_parent->name ?? '<span class="badge badge-danger">NONE</span>';
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
        return view('admin.pages.category.form', [
            'page_title' => 'Create Category',
            'data' => $data,
            'category_parent' => $this->categories->where('parent_id', null)->get(),
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
            $formdata = [
                'slug' => Str::slug($request->name),
                'name' => $request->name,
                'parent_id' => $request->parent_id,
            ];

            $this->categories->create($formdata);

            DB::commit();
            return $this->success('Data successfully saved!', 'admin.category.index');
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
        $data = $this->categories->whereId($id)->first();
        return view('admin.pages.category.form', [
            'page_title' => 'Edit Category',
            'category_parent' => $this->categories->where('parent_id', null)->get(),
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
            $formdata = [
                'slug' => Str::slug($request->name),
                'name' => $request->name,
                'parent_id' => $request->parent_id,
            ];
            $this->categories->whereId($id)->update($formdata);

            DB::commit();
            return $this->success('Data successfully saved!', 'admin.category.index');
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
            $this->categories->whereId($id)->delete();
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
