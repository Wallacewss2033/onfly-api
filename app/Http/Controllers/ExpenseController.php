<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use App\Models\User;
use App\Notifications\CreateExpenseNotification;
use Illuminate\Http\JsonResponse;
use Notification;

class ExpenseController extends Controller
{
    private Expense $expense;

    public function __construct(Expense $expense)
    {
        $this->expense = $expense;
    }

    public function index(): JsonResponse
    {
        $userId = auth()->user()->id;

        $expenses = $this->expense->join('users', 'expenses.user_id', '=', 'users.id')
            ->select('expenses.*')
            ->where('expenses.user_id', $userId)->get();

        if (!$expenses) {
            return response()->json(['error' => 'Não há despesas.'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $expenses,
            'message' => 'Sucesso!'
        ], 200);
    }

    public function store(ExpenseRequest $request, User $user): JsonResponse
    {
        $id = auth()->user()->id;

        $request["user_id"] = $id;

        $this->expense->create($request->all());

        $dataUser = $user->find($id);

        Notification::send($dataUser, new CreateExpenseNotification($dataUser));

        return response()->json([
            'success' => true,
            'message' => 'Despesa criada com sucesso!'
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $expense = $this->expense->find($id);

        return response()->json([
            'success' => true,
            'data' => $expense,
            'message' => 'Sucesso!'
        ], 200);
    }

    public function update(ExpenseRequest $request, int $id): JsonResponse
    {
        $this->expense->find($id)->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Despesa modificada com sucesso!'
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->expense->find($id)->delete();
        return response()->json(204);
    }
}
