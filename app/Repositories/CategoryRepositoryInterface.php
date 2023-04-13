<?php
namespace App\Repositories;
interface CategoryRepositoryInterface {
    public function all();
    public function store($data);
    public function edit($id);
    public function update($data,$id);
    public function delete($id);

}