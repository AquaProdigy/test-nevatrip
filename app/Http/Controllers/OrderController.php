<?php

namespace App\Http\Controllers;

use App\Helpers\BarCode;
use App\Http\Requests\OrderRequest;
use App\Http\Services\SomeApi;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Mock;

class OrderController extends Controller
{
    public function store(OrderRequest $request)
    {
        /**
         * Saving the order in the database and also checking the uniqueness of the barcode
         *
         * Also performing data validation and barcode validation with a request to a third-party api
         *
         * @param OrderRequest $request Retrieving data from the order request
         *
         * @return JsonResponse Responding with a status and created order
         */

        $validatedData = $request->validated();
        $order = new Order($validatedData);

        do {
            $order->barcode = BarCode::generateBarCode();

            if (Order::where('barcode', $order->barcode)->exists()) {
                continue;
            }
            $response_check = SomeApi::mockRequestCheck($order->toArray());

            if (isset($response_check['message']) && $response_check['message'] === 'order successfully booked') {
                $response_approve = SomeApi::mockRequestApprove($order->barcode);

                if (isset($response_approve['message']) && $response_approve['message'] === 'order successfully aproved') {
                    $order->equal_price = ($order->ticket_adult_price * $order->ticket_adult_quantity) +
                                          ($order->ticket_kid_price * $order->ticket_kid_quantity);
                    $order->save();

                    return response()->json(['success' => true, 'order' => $order]);
                } else {
                    return response()->json(['success' => false, 'error' => $response_approve['error'] ?? 'Failed to approve order'], 400);
                }

            }

        } while (true);



    }


}
