<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCatalogRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roots = Category::roots();
        return view('admin.category.index', compact('roots'));
    }

    public function create() {
        // для возможности выбора родителя
        $parents = Category::roots();
        return view('admin.category.create', compact('parents'));
    }

    public function edit(Category $category) {
        // для возможности выбора родителя
        $parents = Category::roots();
        return view('admin.category.edit', compact('category', 'parents'));
    }

    public function store(CategoryCatalogRequest $request) {
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, null, 'category');
        $category = Category::create($data);
        return redirect()
            ->route('admin.category.show', ['category' => $category->id])
            ->with('success', 'Новая категория успешно создана');
    }
    /* ... */
    public function update(CategoryCatalogRequest $request, Category $category) {
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, $category, 'category');
        $category->update($data);
        return redirect()
            ->route('admin.category.show', ['category' => $category->id])
            ->with('success', 'Категория была успешно исправлена');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category) {
        return view('admin.category.show', compact('category'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category) {
        if ($category->children->count()) {
            $errors[] = 'Нельзя удалить категорию с дочерними категориями';
        }
        if ($category->products->count()) {
            $errors[] = 'Нельзя удалить категорию, которая содержит товары';
        }
        if (!empty($errors)) {
            return back()->withErrors($errors);
        }
        $category->delete();
        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Категория каталога успешно удалена');
    }
}
