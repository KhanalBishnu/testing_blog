<?php
namespace App\Repositories;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface {
    public function all(){
        return Category::all();
    }
    public function store($data){
     return  Category::create($data);
    }

    public function edit($id){
        return  Category::find($id);
    }

    public function update($data,$id){
        $category=Category::find($id);
        if($category){
            $category->update($data);
        }
    }

    public function delete($id){
        $category=Category::find($id);
        if($category){
            $category->delete();
        }
    }
}