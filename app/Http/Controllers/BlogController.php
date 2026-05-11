<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
            'slug'     => 'nullable|string|max:255|unique:blogs,slug',
            'excerpt'  => 'nullable|string|max:500',
            'body'     => 'required|string',
            'tags'     => 'nullable|string|max:255',
            'image'    => 'nullable|image|max:2048',
            'is_active'=> 'boolean',
        ]);

        $data = $request->only(['category_id', 'title', 'excerpt', 'body', 'tags']);
    $slugBase = Str::slug($request->input('slug', $request->title));
    $data['slug'] = $this->generateUniqueSlug($slugBase);
        $data['is_active'] = $request->boolean('is_active', true);
        // Force author to Dr. Yuvraj Jadeja
        $data['author'] = 'Dr. Yuvraj Jadeja';

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
            'slug'     => 'nullable|string|max:255|unique:blogs,slug,' . $blog->id,
            'excerpt'  => 'nullable|string|max:500',
            'body'     => 'required|string',
            'tags'     => 'nullable|string|max:255',
            'image'    => 'nullable|image|max:2048',
            'is_active'=> 'boolean',
        ]);

        $data = $request->only(['category_id', 'title', 'excerpt', 'body', 'tags']);
    $slugBase = Str::slug($request->input('slug', $request->title));
    $data['slug'] = $this->generateUniqueSlug($slugBase, $blog->id);
        $data['is_active'] = $request->boolean('is_active');
        // Ensure author remains Dr. Yuvraj Jadeja
        $data['author'] = 'Dr. Yuvraj Jadeja';

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
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
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();

        return redirect()->route('admin.blogs')
            ->with('success', 'Blog post deleted successfully.');
    }

    private function generateUniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $baseSlug = $slug !== '' ? $slug : 'blog';
        $candidate = $baseSlug;
        $counter = 1;

        while (Blog::where('slug', $candidate)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $candidate = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $candidate;
    }
}
