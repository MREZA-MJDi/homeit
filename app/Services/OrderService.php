<?php


namespace App\Services;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * @param array $data
     * @param int $customerId
     * @return Order
     */
    public function create(array $data, int $customerId): Order
    {
        return DB::transaction(function () use ($data, $customerId) {

            $order = Order::create([

                'customer_id' => $customerId,

                'address_id' => $data['address_id'],

                'status' => 'pending',

                'subtotal' => 0,

                'discount_amount' => 0,

                'total_price' => 0,

                'currency' => 'IRR',

                'payment_status' => 'pending',

                'requested_at' => now(),

                'customer_note' => $data['customer_note'] ?? null,

            ]);

            $this->createItems(
                $order,
                $data['items']
            );

            $this->calculateTotals($order);

            return $order->fresh([
                'items',
                'customer',
                'address',
            ]);
        });
    }

    private function calculateTotals(Order $order): void
    {
        $subtotal = $order
            ->items()
            ->sum('total_price');

        $discount = 0;

        $total = $subtotal - $discount;

        $order->update([

            'subtotal' => $subtotal,

            'discount_amount' => $discount,

            'total_price' => $total,

        ]);
    }

    private function ensureAssignedTechnician(Order $order, User $technician): void
    {
        if ($order->assigned_technician_id !== $technician->id) {

            throw new \Exception(
                'Unauthorized technician.'
            );

        }
    }

    private function createItems(Order $order, array $items): void

    {
        foreach ($items as $item) {

            $service = Service::findOrFail(
                $item['service_id']
            );

            $order->items()->create([

                'service_id' => $service->id,

                'service_title' => $service->title,

                'unit_price' => $service->base_price,

                'estimated_duration' => $service->duration,

                'quantity' => $item['quantity'],

                'total_price' =>
                    $service->base_price *
                    $item['quantity'],

            ]);
        }
    }

    public function update(Order $order, array $data): Order
    {
        return DB::transaction(function () use ($order, $data) {

            if (! $order->isPending()) {

                throw new \Exception(
                    'This order can no longer be updated.'
                );

            }

            $order->update([

                'address_id' => $data['address_id'],

                'customer_note' =>

                    $data['customer_note'] ?? null,

            ]);

            if (isset($data['items'])) {

                $this->updateItems(
                    $order,
                    $data['items']
                );

            }

            $this->calculateTotals($order);

            return $order->fresh([
                'items',
                'customer',
                'address',
            ]);

        });
    }

    private function updateItems(Order $order, array $items): void
    {
        $order->items()->delete();

        $this->createItems(
            $order,
            $items
        );
    }


    public function assignTechnician(Order $order, User $technician, User $admin): Order
    {
        if (! $order->isPending()) {

            throw new \Exception(
                'Order is not pending.'
            );

        }

        if (!$technician->hasRole('Technician')) {

            throw new \Exception(
                'Invalid technician.'
            );

        }

        if (!optional(
            $technician->technicianProfile
        )->is_available) {

            throw new \Exception(
                'Technician is unavailable.'
            );

        }
        $order->loadMissing('items');

        foreach ($order->items as $item) {

            $exists = $technician
                ->technicianServices()
                ->where(
                    'service_id',
                    $item->service_id
                )
                ->exists();

            if (!$exists) {

                throw new \Exception(
                    "Technician cannot perform {$item->service_title}"
                );

            }

        }

        $order->update([

            'assigned_technician_id' =>

                $technician->id,

            'assigned_by' =>

                $admin->id,

            'assigned_at' =>

                now(),

            'status' =>

                'assigned',

        ]);

        return $order->fresh([
            'items',
            'customer',
            'technician',
        ]);
    }

    public function accept(Order $order, User $technician): Order
    {
        if (!$order->isAssigned()) {

            throw new \Exception(
                'Order is not assigned.'
            );

        }

        $this->ensureAssignedTechnician(
            $order,
            $technician
        );

        $order->update([

            'status' => 'accepted',

            'accepted_at' => now(),

        ]);

        return $order->fresh([
            'items',
            'customer',
            'technician',
        ]);
    }

    public function onTheWay(Order $order, User $technician): Order

    {
        if (!$order->isAccepted()) {

            throw new \Exception(
                'Order has not been accepted.'
            );
        }

        $this->ensureAssignedTechnician(
            $order,
            $technician
        );

        $order->update([
            'status' => 'on_the_way',
        ]);

        return $order->fresh([
            'items',
            'customer',
            'technician',
        ]);
    }


    public function start(Order $order, User $technician): Order
    {
        if (!$order->isOnTheWay()) {

            throw new \Exception(
                'Technician is not on the way.'
            );

        }

        $this->ensureAssignedTechnician(
            $order,
            $technician
        );

        $order->update([

            'status' => 'in_progress',

            'started_at' => now(),

        ]);

        return $order->fresh([
            'items',
            'customer',
            'technician',
        ]);
    }

    public function complete(Order $order, User $technician): Order
    {
        if (!$order->isInProgress()) {

            throw new \Exception(
                'Order is not in progress.'
            );

        }

        $this->ensureAssignedTechnician(
            $order,
            $technician
        );

        $order->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        return $order->fresh([
            'items',
            'customer',
            'technician',
        ]);
    }

    public function cancel(Order $order, User $user, string $reason): Order
    {
        if (
            in_array(
                $order->status,
                ['completed', 'cancelled']
            )
        ) {

            throw new \Exception(
                'Order cannot be cancelled.'
            );

        }

        $order->update([

            'status' => 'cancelled',

            'cancelled_at' => now(),

            'cancelled_by' => $user->id,

            'cancel_reason' => $reason,

        ]);

        return $order->fresh([
            'items',
            'customer',
            'technician',
        ]);
    }

    public function index(int $perPage = 15)
    {
        return Order::with([
            'customer',
            'technician',
            'address',
            'items.service',
        ])
            ->latest()
            ->paginate($perPage);
    }

    public function show(Order $order): Order
    {
        return $order->load([
            'customer',
            'technician',
            'address',
            'items.service',
        ]);
    }

}
