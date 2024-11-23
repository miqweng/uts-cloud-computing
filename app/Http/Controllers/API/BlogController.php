<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\CategoryBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    function getDataBlog()
    {
        $data = Blog::with(['category'])->orderBy('sequence_post', 'ASC')->get()->groupBy('category.name');

        return response()->json([
            'message' => 'data found',
            'data' => $data
        ], 200);
    }
    function getDataSecquence($category_id, $number)
    {
        $nextData = Blog::where('category_blog_id', $category_id)->where('sequence_post', $number + 1)->first();
        $prevData = Blog::where('category_blog_id', $category_id)->where('sequence_post', $number - 1)->first();

        return response()->json([
            'message' => 'data found',
            'nextData' => $nextData,
            'prevData' => $prevData,
        ], 200);
    }
    function getDataBlogBySlug($slug)
    {
        $data = Blog::where('slug', $slug)->first();

        if ($data) {
            $result = [
                'title' => $data->title,
                'image' => $data->image,
                'slug' => $data->slug,
                'description' => $data->description,
                'sequence_post' => $data->sequence_post,
                'category_blog_id' => $data->category_blog_id,
                'category_name' => $data->category->name ?? 'UNCATEGORIES'
            ];
        } else {
            $result = null;
        }
        return response()->json([
            'message' => 'data found',
            'data' => $result
        ], 200);
    }

    function getDataBlogByCategory($category)
    {
        $dataSlug = Str::lower($category);
        $category_id = CategoryBlog::where('slug', $dataSlug)->first()->id;
        $data = Blog::where('category_blog_id', $category_id)->orderBy('sequence_post','ASC')->get()->map(function ($data) {
            return [
                'title' => $data->title,
                'image' => $data->image,
                'slug' => $data->slug,
                'category_name' => $data->category->name ?? 'UNCATEGORIES'
            ];
        });
        return response()->json([
            'message' => 'data found',
            'data' => $data
        ], 200);
    }
}
