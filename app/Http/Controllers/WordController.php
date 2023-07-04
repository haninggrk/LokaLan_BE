<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class WordController extends Controller
{
    public function index()
    {
        $words = Word::with('usageExamples')->get();
        return response()->json([
            'success' => true,
            'data' => $words
        ]);
    }

    


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'word' => 'required',
            'meaning' => 'required',
            'description' => 'required',
            'audio_path' => 'nullable',
            'upvote' => 'nullable|integer',
            'downvote' => 'nullable|integer',
            'user_id' => 'required|exists:users,id',
            'usage_examples' => 'array',
            'usage_examples.*.example' => 'string',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }
    
        $word = Word::create($request->only([
            'word', 'meaning', 'description', 'audio_path', 'upvote', 'downvote', 'user_id'
        ]));
    
        if ($request->has('usage_examples')) {
            foreach ($request->input('usage_examples') as $usageExampleData) {
                $word->usageExamples()->create([
                    'example' => $usageExampleData['example']
                ]);
            }
        }
    
        $word->refresh();
    
        return response()->json([
            'success' => true,
            'data' => $word
        ], 201);
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'word' => 'required',
            'meaning' => 'required',
            'description' => 'required',
            'audio_path' => 'nullable',
            'upvote' => 'nullable|integer',
            'downvote' => 'nullable|integer',
            'user_id' => 'required|exists:users,id',
            'usage_examples' => 'array',
            'usage_examples.*.example' => 'string',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }
    
        $word = Word::findOrFail($id);
        $word->update($request->only([
            'word', 'meaning', 'description', 'audio_path', 'upvote', 'downvote', 'user_id'
        ]));
    
        if ($request->has('usage_examples')) {
            $word->usageExamples()->delete();
    
            foreach ($request->input('usage_examples') as $usageExampleData) {
                $word->usageExamples()->create([
                    'example' => $usageExampleData['example']
                ]);
            }
        }
    
        $word->refresh();
        
        return response()->json([
            'success' => true,
            'data' => $word
        ]);
    }
    
    public function show($id)
    {
        $word = Word::with('usageExamples')->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $word
        ]);
    }

    public function destroy($id)
    {
        $word = Word::findOrFail($id);
        $word->usageExamples()->delete(); // Delete associated usage examples
        $word->delete(); // Delete the word itself
    
        return response()->json([
            'success' => true,
            'message' => 'Word and associated examples deleted successfully'
        ]);
    }


}
