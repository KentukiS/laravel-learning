<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends BaseController
{

    private $blogCategoryRepository;
    public function __construct()
    {
        parent:: __construct();

        $this->blogCategoryRepository = new BlogCategoryRepository();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $paginator = BlogCategory::paginate(5);
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(5);
        return view('blog.admin.category.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogCategory(); // может работать некорректно с несколькими сущностями, лучше find или where
        $categoryList = $this->blogCategoryRepository->getForComboBox();
        return view('blog.admin.category.edit',
            compact('item','categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input();
        if(empty($data['slug'])){
            $data['slug'] = Str::slug($data['title']);
        }
        $item = new BlogCategory($data);
        $item->save();
        if($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено!']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, BlogCategoryRepository $categoryRepository)
    {
        //$item = BlogCategory::query()->findOrFail($id); // может работать некорректно с несколькими сущностями, лучше find или where
        //$categoryList = BlogCategory::all();

        $item = $this->blogCategoryRepository->getEdit($id);
        if(empty($item)) {
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.category.edit',
            compact('item','categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = BlogCategory::find($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();
        $result = $item //можем юзать update() вместо fill->save
            ->fill($data) //записываем данные в обьект
            ->save(); // в базу
        if($result) {
            return redirect()
                ->route('blog.admin.categories.edit',$item->id)
                ->with(['success' => "Успешно сохранено!"]);
        } else {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }
    }

}
