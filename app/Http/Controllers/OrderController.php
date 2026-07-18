<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignTechnicianRequest;
use App\Http\Requests\CancelOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{

    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Order::class);

        return response()->json(
            $this->orderService->index()
        );
    }

    public function show(Order $order): JsonResponse
    {
        $this->authorize('view', $order);

        return response()->json(
            $this->orderService->show($order)
        );
    }

    public function store(StoreOrderRequest $request): JsonResponse
    {
        $this->authorize('create', Order::class);

        $order = $this->orderService->create(
            $request->validated(),
            auth()->id()
        );

        return response()->json([
            'message' => 'Order created successfully.',
            'data' => $order,
        ], 201);
    }

    public function update(UpdateOrderRequest $request, Order $order): JsonResponse
    {
        $this->authorize('update', $order);

        $order = $this->orderService->update(
            $order,
            $request->validated()
        );

        return response()->json([
            'message' => 'Order updated successfully.',
            'data' => $order,
        ]);
    }

    public function assignTechnician(AssignTechnicianRequest $request, Order $order): JsonResponse
    {
        $this->authorize('assignTechnician', $order);

        $technician = User::findOrFail(
            $request->validated('technician_id')
        );

        $order = $this->orderService->assignTechnician(
            $order,
            $technician,
            auth()->user()
        );

        return response()->json([
            'message' => 'Technician assigned successfully.',
            'data' => $order,
        ]);
    }

    public function accept(Order $order): JsonResponse
    {
        $this->authorize('accept', $order);

        $order = $this->orderService->accept(
            $order,
            auth()->user()
        );

        return response()->json([
            'message' => 'Order accepted.',
            'data' => $order,
        ]);
    }

    public function onTheWay(Order $order): JsonResponse
    {
        $this->authorize('onTheWay', $order);

        $order = $this->orderService->onTheWay(
            $order,
            auth()->user()
        );

        return response()->json([
            'message' => 'Technician is on the way.',
            'data' => $order,
        ]);
    }

    public function start(Order $order): JsonResponse
    {
        $this->authorize('start', $order);

        $order = $this->orderService->start(
            $order,
            auth()->user()
        );

        return response()->json([
            'message' => 'Work started.',
            'data' => $order,
        ]);
    }

    public function complete(Order $order): JsonResponse
    {
        $this->authorize('complete', $order);

        $order = $this->orderService->complete(
            $order,
            auth()->user()
        );

        return response()->json([
            'message' => 'Order completed.',
            'data' => $order,
        ]);
    }

    public function cancel(CancelOrderRequest $request, Order $order): JsonResponse
    {
        $this->authorize('cancel', $order);

        $order = $this->orderService->cancel(
            $order,
            auth()->user(),
            $request->validated('reason')
        );

        return response()->json([
            'message' => 'Order cancelled.',
            'data' => $order,
        ]);
    }

}
