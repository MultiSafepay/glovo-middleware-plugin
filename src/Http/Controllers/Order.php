<?php

declare(strict_types=1);

namespace GlovoPlugin\Http\Controllers;

use GlovoPlugin\Http\Requests\OrderAccept as RequestsOrderAccept;
use GlovoPlugin\Jobs\OrderDispatched;
use GlovoPlugin\Jobs\OrderAccept;
use GlovoPlugin\Jobs\OrderCancelled;
use Illuminate\Http\Request;

class Order extends Controller
{
    public function dispatched(Request $request): void
    {
        $job = new OrderDispatched();

        $job->dispatch($request->all());
    }

    public function accepted(RequestsOrderAccept $request): void
    {
        $job = new OrderAccept();

        $job->dispatch($request->all());
    }

    public function cancelled(Request $request): void
    {
        $job = new OrderCancelled();

        $job->dispatch($request->all());
    }
}
