<?php

declare(strict_types=1);

namespace GlovoPlugin\Jobs;

use GlovoModels\Enum\OrderStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use GlovoPlugin\Api\ApiRequest as BackendApi;
use GlovoPlugin\Glovo\Orders\Api as OrderApi;

class OrderAccept implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Failed;

    /**
     *
     * @var array<string, array<string>>|array<string, string> $data
     */
    private array $data;

    /**
     * Execute the job.
     *
     * @param array<string, array<string>>|array<string, string> $request
     *
     * @return void
     */
    public function handle(array $request): void
    {
        $this->data = $request;

        $this->acceptOrder();
        $this->confirmAccepted();
    }

    private function acceptOrder(): void
    {
        $orderApi = new OrderApi();

        $data = $this->data;

        $orderApi->updateStatus($data['storeId'], $data['orderId'], OrderStatus::accepted);
    }

    private function confirmAccepted(): void
    {
        $api = new BackendApi();

        $api->confirm('order-acceptted', $this->data);
    }
}
