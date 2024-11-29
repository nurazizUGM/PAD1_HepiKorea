<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // FAQ page for admin
    public function index()
    {
        $faqs = Faq::all();
        return view('admin.faq', compact('faqs'));
    }

    // Store new FAQ
    public function store(Request $request)
    {
        $data = $request->validate([
            'new_question' => 'required',
            'new_answer' => 'required',
        ]);

        Faq::create([
            'question' => $data['new_question'],
            'answer' => $data['new_answer'],
        ]);
        return redirect()->back()->with('success', 'Faq added successfully');
    }

    // Update FAQ
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        Faq::where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Faq updated successfully');
    }

    // Delete FAQ
    public function delete($id)
    {
        Faq::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Faq deleted successfully');
    }

    // FAQ page for customer
    public function faq()
    {
        $faqs = Faq::all();
        return view('customer.faq', compact('faqs'));
    }
}
