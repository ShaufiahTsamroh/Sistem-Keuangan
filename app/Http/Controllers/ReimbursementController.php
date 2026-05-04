<?php

namespace App\Http\Controllers;

use App\Models\Reimbursement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class ReimbursementController extends Controller
{
    public function index()
    {
        $data = Reimbursement::where('user_id', Auth::id())->get();
        return view('reimburse.index', compact('data'));
    }

    public function create()
    {
        return view('reimburse.create');
    }

    public function store(Request $request)
    {
        Reimbursement::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'description' => $request->description,
            'status' => 'pending',
            'date' => $request->date,
        ]);

        return redirect('/reimburse');
    }

    public function review()
    {
        $data = Reimbursement::all();
        return view('bendahara.reimburse', compact('data'));
    }

    public function approve($id)
{
    $data = Reimbursement::findOrFail($id);

    if ($data->status == 'approved') {
        return redirect()->back();
    }

    $data->status = 'approved';
    $data->save();

    Transaction::create([
        'user_id' => $data->user_id,
        'type' => 'keluar',
        'amount' => $data->amount,
        'description' => $data->description,
        'category_id' => 1,
        'date' => $data->date,
    ]);

    return redirect()->back();
}
    
    public function reject($id)
    {
        $data = Reimbursement::find($id);
        $data->status = 'rejected';
        $data->save();

        return redirect()->back();
    }
}