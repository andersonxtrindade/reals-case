<?php

namespace App\Services;

use App\Models\Affiliates;
use Illuminate\Database\Eloquent\Collection;

class AffiliatesService 
{
    public function index(): Collection
    {
        return Affiliates::with('commission')->get();
    }

    public function show(int $id): Affiliates
    {
        return Affiliates::with('commission')->findOrfail($id);
    }

    public function store(array $data): Affiliates
    {
        return Affiliates::create($data); 
    }

    public function update(array $data, int $id): Affiliates
    {
        $affiliates = $this->show($id);

        $affiliates->update($data);

        return $affiliates->refresh();
    }

    public function destroy(int $id): bool
    {
        $affiliates = $this->show($id);

        return $affiliates->delete();
    }
}