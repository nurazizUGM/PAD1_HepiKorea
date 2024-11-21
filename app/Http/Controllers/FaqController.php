<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        return view('admin.faq', compact('faqs'));
    }

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

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        Faq::where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Faq updated successfully');
    }

    public function delete($id)
    {
        Faq::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Faq deleted successfully');
    }

    public function faq()
    {
        $faqs = Faq::all();
        return view('customer.faq', compact('faqs'));
    }
}
