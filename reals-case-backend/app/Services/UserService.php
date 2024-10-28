<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService 
{
    public function index(): Collection
    {
        return User::get();
    }

    public function show(int $id): User
    {
        return User::findOrfail($id);
    }

    public function store(array $data): User
    {
        return User::create($data); 
    }

    public function update(array $data, int $id): User
    {
        $user = $this->show($id);
        
        $fillableFields = ['name', 'email', 'active']; 
        $filteredData = array_intersect_key($data, array_flip($fillableFields));
        
        $user->update($filteredData);
    
        return $user->refresh();
    }

    public function destroy(int $id): bool
    {
        $user = $this->show($id);

        return $user->delete();
    }
}