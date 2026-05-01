<?php

namespace App\Http\Controllers;

use App\Models\QuizQuestion;
use App\Models\QuizSubmission;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    // Question Management
    public function index()
    {
        $questions = QuizQuestion::orderBy('order')->get();
        return view('admin.quiz.index', compact('questions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'gender' => 'required|in:f,m',
            'order' => 'required|integer'
        ]);

        QuizQuestion::create($request->all());

        return redirect()->back()->with('success', 'Question added successfully.');
    }

    public function update(Request $request, QuizQuestion $quizQuestion)
    {
        $request->validate([
            'question' => 'required|string',
            'gender' => 'required|in:f,m',
            'order' => 'required|integer'
        ]);

        $quizQuestion->update($request->all());

        return redirect()->back()->with('success', 'Question updated successfully.');
    }

    public function destroy(QuizQuestion $quizQuestion)
    {
        $quizQuestion->delete();
        return redirect()->back()->with('success', 'Question deleted successfully.');
    }

    // Submission Management
    public function submissions()
    {
        $submissions = QuizSubmission::orderBy('created_at', 'desc')->get();
        return view('admin.quiz.submissions', compact('submissions'));
    }

    public function submissionDetails(QuizSubmission $submission)
    {
        return view('admin.quiz.submission-details', compact('submission'));
    }

    public function destroySubmission(QuizSubmission $submission)
    {
        $submission->delete();
        return redirect()->back()->with('success', 'Submission deleted successfully.');
    }
}
