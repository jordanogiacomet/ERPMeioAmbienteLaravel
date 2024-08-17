<?php

namespace App\Repositories;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface DefaultRepositoryInterface
{
    public function all(): callable|Collection;
    public function find(int|string $id): callable|Model;
    public function create(FormRequest $data): callable|Model;
    public function update(int|string $id, FormRequest $data): callable|Model;
    public function delete(int|string $id): void;
}