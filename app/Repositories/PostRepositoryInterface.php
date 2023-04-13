<?php
namespace App\Repositories;
interface PostRepositoryInterface {
    public function all();
    public function store($data);
    public function edit($id);
    // public function update($data,$id);
    // public function delete($id);
}