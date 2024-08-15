<?php

namespace App\Repositories;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface DefaultRepositoryInterface
{
    public function all(): Collection;
    public function find(int|string $id): ?Model;
    public function create(FormRequest $data): Model;
    public function update(int|string $id, FormRequest $data): Model;
    public function delete(int|string $id): void;
}