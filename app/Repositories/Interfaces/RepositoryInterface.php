<?php namespace App\Repositories\Interfaces;

interface RepositoryInterface
{
    public function all($columns = array('*'));

    public function create(array $attributes, $parent = false);

    public function find($id, $columns = array('*'));

    public function update($object, array $attributes);

    public function delete($id);
}
