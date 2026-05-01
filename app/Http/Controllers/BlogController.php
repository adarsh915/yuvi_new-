<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Category;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category_rel')->orderBy('created_at', 'desc')->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'    => 'required|string|max:255',
            'excerpt'  => 'nullable|string|max:500',
            'body'     => 'required|string',
            'tags'     => 'nullable|string|max:255',
            'author'   => 'nullable|string|max:100',
            'image'    => 'nullable|image|max:2048',
            'is_active'=> 'boolean',
        ]);

        $data = $request->only(['category_id', 'title', 'excerpt', 'body', 'tags', 'author']);
        $data['slug']      = Str::slug($request->title);
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        Blog::create($data);

        return redirect()->route('admin.blogs')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(Blog $blog)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'    => 'required|string|max:255',
            'excerpt'  => 'nullable|string|max:500',
            'body'     => 'required|string',
            'tags'     => 'nullable|string|max:255',
            'author'   => 'nullable|string|max:100',
            'image'    => 'nullable|image|max:2048',
            'is_active'=> 'boolean',
        ]);

        $data = $request->only(['category_id', 'title', 'excerpt', 'body', 'tags', 'author']);
        $data['slug']      = Str::slug($request->title);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            if ($blog->image) {
                \Storage::disk('public')->delete($blog->image);
            }
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        $blog->update($data);

        return redirect()->route('admin.blogs')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            \Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();

        return redirect()->route('admin.blogs')
            ->with('success', 'Blog post deleted successfully.');
    }
}
