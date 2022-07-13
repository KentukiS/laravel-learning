<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;

class BlogCategoryRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    //получить модель для редактирования в админке
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    //получаем список категорий для вывода в выпадающем списке
    public function getForComboBox()
    {
//        return $this->startConditions()->all();
        $columns = implode(", ", [
            'id',
            'CONCAT (id,". ", title) AS id_title',
        ]);
        /* $result[] = $this->startConditions()->all();
        $result[] = $this
            ->startConditions()
            ->select('blog_categories.*',\DB::raw('CONCAT (id,". ", title) AS id_title'))
            ->toBase() //убираем 'обертки'
            ->get(); */

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        return $result;
    }

    public function getAllWithPaginate($perPage = null)
    {
        $columns = ['id','title','parent_id'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->paginate($perPage,$columns);
        return $result;
    }
}
