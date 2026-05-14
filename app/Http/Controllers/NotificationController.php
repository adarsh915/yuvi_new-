<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\QuizSubmission;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $leads = Lead::orderBy('created_at', 'desc')->get()->map(function($item) {
            $item->type = 'Contact Lead';
            $item->icon = 'solar:user-speak-outline';
            $item->color = 'primary';
            $item->route = route('admin.leads.details', $item->id);
            return $item;
        });

        $quizzes = QuizSubmission::orderBy('created_at', 'desc')->get()->map(function($item) {
            $item->type = 'Quiz Submission';
            $item->icon = 'solar:quiz-outline';
            $item->color = 'success';
            $item->route = route('admin.quiz.submissions.details', $item->id);
            return $item;
        });

        $notifications = $leads->concat($quizzes)->sortByDesc('created_at');

        return view('admin.notifications.index', compact('notifications'));
    }

    public function markAsRead($type, $id)
    {
        if ($type === 'lead') {
            $notification = Lead::findOrFail($id);
        } else {
            $notification = QuizSubmission::findOrFail($id);
        }

        $notification->update(['is_read' => true]);

        return back()->with('success', 'Marked as read');
    }

    public function markAllAsRead()
    {
        Lead::where('is_read', false)->update(['is_read' => true]);
        QuizSubmission::where('is_read', false)->update(['is_read' => true]);

        return back()->with('success', 'All notifications marked as read');
    }

    /**
     * Get recent notifications for header
     */
    public static function getRecentNotifications($limit = 5)
    {
        $leads = Lead::where('is_read', false)->orderBy('created_at', 'desc')->take($limit)->get()->map(function($item) {
            $item->route = route('admin.leads.details', $item->id);
            return $item;
        });
        $quizzes = QuizSubmission::where('is_read', false)->orderBy('created_at', 'desc')->take($limit)->get()->map(function($item) {
            $item->route = route('admin.quiz.submissions.details', $item->id);
            return $item;
        });

        return $leads->concat($quizzes)->sortByDesc('created_at')->take($limit);
    }

    public static function getUnreadCount()
    {
        return Lead::where('is_read', false)->count() + QuizSubmission::where('is_read', false)->count();
    }
}
