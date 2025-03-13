<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // Get all FAQs
    public function findAll()
    {
        return response()->json(Faq::all());
    }

    // Store new FAQ
    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        Faq::create([
            'question' => $data['question'],
            'answer' => $data['answer'],
        ]);

        return response()->json(['message' => 'Faq created successfully']);
    }

    // Update FAQ
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        Faq::find($id)->update($data);
        return response()->json(['message' => 'Faq updated successfully']);
    }

    // Delete FAQ
    public function delete($id)
    {
        Faq::where('id', $id)->delete();
        return response()->json(['message' => 'Faq deleted successfully']);
    }
}
