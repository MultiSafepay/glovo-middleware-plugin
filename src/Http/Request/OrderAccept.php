<?php

declare(strict_types=1);

namespace GlovoPlugin\Http\Requests;

class OrderAccept extends Request
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'storeId' => 'required|uuid',
            'orderId' => 'required|uuid',
        ];
    }
}
