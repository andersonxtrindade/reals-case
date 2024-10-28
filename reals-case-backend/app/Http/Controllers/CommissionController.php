<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommissionRequest;
use App\Http\Requests\UpdateCommissionRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CommissionService;
use Symfony\Component\HttpFoundation\JsonResponse;

class CommissionController extends Controller
{
    public function index(): JsonResponse
    {
        $commissionService = new CommissionService();

        return response()->json($commissionService->index());
    }

    public function show(int $id): JsonResponse
    {
        $commissionService = new CommissionService();

        return response()->json($commissionService->show($id));
    }

    public function store(Request $request): JsonResponse
    {
        $commissionService = new CommissionService();

        return response()->json($commissionService->store($request->all()));
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $commissionService = new CommissionService();

        return response()->json($commissionService->update($request->all(), $id));
    }

    public function destroy(int $id): JsonResponse
    {
        $commissionService = new CommissionService();

        if(!$commissionService->destroy($id)) {
            return response()->json([
                "message" => "Não foi possível deletar esse registro {$id}!"
            ]);
        }

        return response()->json([
            "message" => "Registro {$id} deletado com sucesso!"
        ]);
    }
}
