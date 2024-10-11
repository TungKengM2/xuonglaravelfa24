<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{

    public function startTransaction(Request $request)
    {
        $transactionId = uniqid('txn_', true);

        Session::put('transaction_id', $transactionId);
        Session::put('amount', $request->input('amount'));
        Session::put('target_account', $request->input('target_account'));
        Session::put('status', 'in_progress');

        return response()->json([
            'message' => 'Bắt đầu giao dịch',
            'transaction_id' => $transactionId,
        ]);
    }

    public function processTransaction(Request $request)
    {
        if (Session::has('transaction_id')) {
            Session::put('step', $request->input('step'));

            return response()->json([
                'message' => 'Đã lưu giao dịch',
                'step' => $request->input('step'),
            ]);
        }
        return response()->json(['message' => 'Không có hoạt dộng giao dịch nào'], 400);
    }

    public function completeTransaction()
    {
        if (Session::has('transaction_id')) {
            $transactionId = Session::get('transaction_id');
            $amount = Session::get('amount');
            $targetAccount = Session::get('target_account');

            Session::forget('transaction_id');
            Session::forget('amount');
            Session::forget('target_account');
            Session::forget('status');
            Session::forget('step');

            return response()->json(['message' => 'Hoàn thành giao dịch']);
        }

        return response()->json(['message' => 'Không có hoạt dộng giao dịch nào'], 400);
    }

    public function cancelTransaction()
    {
        if (Session::has('transaction_id')) {
            Session::forget('transaction_id');
            Session::forget('amount');
            Session::forget('target_account');
            Session::forget('status');
            Session::forget('step');

            return response()->json(['message' => 'Đã thoát giao dịch']);
        }

        return response()->json(['message' => 'Không có hoạt dộng giao dịch nào'], 400);
    }

    public function resumeTransaction()
    {
        if (Session::has('transaction_id')) {
            $transactionData = [
                'transaction_id' => Session::get('transaction_id'),
                'amount' => Session::get('amount'),
                'target_account' => Session::get('target_account'),
                'step' => Session::get('step'),
                'status' => Session::get('status'),
            ];

            return response()->json([
                'message' => 'Tiếp tục giao dịch',
                'data' => $transactionData
            ]);
        }

        return response()->json(['message' => 'Không có hoạt dộng giao dịch nào'], 400);
    }
}
