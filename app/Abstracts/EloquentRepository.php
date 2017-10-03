<?php namespace App\Abstracts;

use App\Repositories\Interfaces\RepositoryInterface;

abstract class EloquentRepository implements RepositoryInterface
{
    protected $query;
    protected $model;

    public function __construct()
    {
        $this->scopeReset();
    }

    public function initQuery()
    {
        $this->query = $this->model->newInstance()->newQuery();

        return $this;
    }

    public function all($columns = array('*'))
    {
        return $this->query->get($columns);
    }

    public function paginate($perPage, $columns = array('*'), $page = null)
    {
        return $this->query->paginate($perPage, $columns, 'page', $page);
    }

    public function create(array $attributes, $parent = false)
    {
        return $this->model->create($attributes);
    }

    public function find($id, $columns = array('*'))
    {
        return $this->query->find($id);
    }

    public function findOrFail($id, $columns = array('*'))
    {
        return $this->query->findOrFail($id);
    }

    public function findBySlug($slug, $columns = array('*'))
    {
        return $this->where([
            'slug'  => $slug
        ])->firstOrFail($columns);
    }

    public function first(array $columns = array('*'))
    {
        return $this->query->first($columns);
    }

    public function firstOrFail(array $columns = array('*'))
    {
        return $this->query->firstOrFail($columns);
    }

    public function where($arguments, $operator = null, $value = null)
    {
        $this->query->where($arguments, $operator, $value);

        return $this;
    }

    public function with($relations): self
    {
        $this->query->with($relations);

        return $this;
    }

    public function withCount($relations): self
    {
        $this->query->withCount($relations);

        return $this;
    }

    public function orderBy($column, string $direction = 'asc')
    {
        if (is_array($column)) {
            $this->query->orderBy($column[0], $column[1]);
        } else {
            $this->query->orderBy($column, $direction);
        }

        return $this;
    }

    public function update($id, array $attributes)
    {
        $object = $this->where('id', '=', $id)->first();

        $object->update($attributes);

        return $object;
    }

    public function attach($object, string $relation, array $related_ids)
    {
        $object->$relation()->attach($related_ids);

        return true;
    }

    public function detach($object, string $relation, array $related_ids)
    {
        $object->$relation()->detach($related_ids);

        return true;
    }

    public function delete($id)
    {
        $this->scopeReset();

        $object = $this->find($id);

        return $object->delete();
    }

    protected function scopeReset()
    {
        $this->initQuery();
    }
}
