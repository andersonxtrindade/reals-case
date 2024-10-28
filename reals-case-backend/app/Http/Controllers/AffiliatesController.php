<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAffiliatesRequest;
use App\Http\Requests\UpdateAffiliatesRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AffiliatesService;
use Symfony\Component\HttpFoundation\JsonResponse;

class AffiliatesController extends Controller
{
    public function index(): JsonResponse
    {
        $affiliatesService = new AffiliatesService();

        return response()->json($affiliatesService->index());
    }

    public function show(int $id): JsonResponse
    {
        $affiliatesService = new AffiliatesService();

        return response()->json($affiliatesService->show($id));
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cpf' => 'required|string', 
            'birth_date' => 'required|date|date_format:Y-m-d',
            'email' => 'required|email|max:255|unique:users,email',
            'number_phone' => 'required', 
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'active' => 'required|boolean',
        ]);
        $affiliatesService = new AffiliatesService();

        return response()->json($affiliatesService->store($request->all()));
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $affiliatesService = new AffiliatesService();

        return response()->json($affiliatesService->update($request->all(), $id));
    }

    public function destroy(int $id): JsonResponse
    {
        $affiliatesService = new AffiliatesService();

        if(!$affiliatesService->destroy($id)) {
            return response()->json([
                "message" => "Não foi possível deletar esse registro {$id}!"
            ]);
        }

        return response()->json([
            "message" => "Registro {$id} deletado com sucesso!"
        ]);
    }
}
