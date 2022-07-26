<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Database\Eloquent\Collection;

class BlogPostRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllWithPaginate()
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id','DESC')
//            ->with(['category','user']) //избыточный вариант
            ->with([
                //два варианта
                'category' => function ($query) {
                    $query->select(['id','title']);
                },
                'user:id,name',
            ])
            ->paginate(25);
//        dd($result);
        return $result;
    }
}
