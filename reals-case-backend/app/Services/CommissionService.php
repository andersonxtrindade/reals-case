<?php

namespace App\Services;

use App\Models\Commission;
use Illuminate\Database\Eloquent\Collection;

class CommissionService 
{
    public function index(): Collection
    {
        return Commission::get();
    }

    public function show(int $id): Commission
    {
        return Commission::findOrfail($id);
    }

    public function store(array $data): Commission
    {
        return Commission::create($data); 
    }

    public function update(array $data, int $id): Commission
    {
        $commission = $this->show($id);

        $commission->update($data);

        return $commission->refresh();
    }

    public function destroy(int $id): bool
    {
        $commission = $this->show($id);

        return $commission->delete();
    }
}