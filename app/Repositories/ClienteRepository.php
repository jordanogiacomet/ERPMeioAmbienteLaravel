<?php

namespace App\Repositories;

use App\Models\Cliente;

class ClienteRepository extends DefaultRepository implements ClienteRepositoryInterface
{
    public function __construct(Cliente $model)
    {
        parent::__construct($model);
    }
}