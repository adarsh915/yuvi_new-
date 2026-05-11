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
    public function submissions(\Illuminate\Http\Request $request)
    {
        $query = QuizSubmission::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->input('phone') . '%');
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->input('city') . '%');
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }

        $submissions = $query->orderBy('created_at', 'desc')->get();

        $questionMap = QuizQuestion::pluck('question', 'id');

        return view('admin.quiz.submissions', compact('submissions', 'questionMap'));
    }

    public function exportSubmissions(\Illuminate\Http\Request $request)
    {
        $query = QuizSubmission::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->input('phone') . '%');
        }
        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->input('city') . '%');
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }

        $submissions = $query->orderBy('created_at', 'desc')->get();

        $csvRows = [];
        $csvRows[] = ['Date', 'Name', 'Phone', 'Email', 'City'];

        foreach ($submissions as $submission) {
            $csvRows[] = [
                $submission->created_at->format('Y-m-d H:i:s'),
                $submission->name,
                $submission->phone,
                $submission->email ?? '',
                $submission->city ?? '',
            ];
        }

        $filename = 'quiz_submissions_' . now()->format('Ymd_His') . '.csv';

        $callback = function () use ($csvRows) {
            $out = fopen('php://output', 'w');
            foreach ($csvRows as $row) {
                fputcsv($out, $row);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function printSubmission(QuizSubmission $submission)
    {
        $submission->load([]);
        $questionMap = QuizQuestion::pluck('question', 'id');

        return view('admin.quiz.submission-print', compact('submission', 'questionMap'));
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
