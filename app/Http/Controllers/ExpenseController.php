<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    function showExpense()
    {
        $expenses = Expense::with('category')->where('is_active',1)->get();
        $categories = Category::where('is_active',1)->get();
        return view('expense',get_defined_vars());
    }
    function addExpense(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required',
            'amount' => 'required',
            'date' => 'required'
        ]);

        $expenses = new Expense;
        $expenses->title = $request->title;
        $expenses->category_id = $request->category;
        $expenses->amount = $request->amount;
        $expenses->description = $request->description;
        $expenses->date = $request->date;
        $expenses->save();

    }

    public function updateExpense(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|integer',
        'amount' => 'required|numeric',
        'date' => 'required|date',
        'description' => 'nullable|string'
    ]);

    $expense = Expense::findOrFail($request->id);
    $expense->title = $request->title;
    $expense->category_id = $request->category;
    $expense->amount = $request->amount;
    $expense->description = $request->description;
    $expense->date = $request->date;
    $expense->save();

}


    function deleteExpense($expns_id)
    {
        $expense = Expense::findOrFail($expns_id);
        $expense->is_active = 0;
        $expense->save();
        session()->flash('errorMsg', 'Expense successfully deleted!');
        return redirect()->route('expense');
    }
}
