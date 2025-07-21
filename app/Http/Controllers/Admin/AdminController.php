<?php

// app/Http/Controllers/Admin/AdminController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AnnouncementNotification;

class AdminController extends Controller
{
    // Dashboard overview for admin
    public function dashboard()
    {
        $parentsCount   = User::whereHas('role', fn($q) => $q->where('name', 'parent'))->count();
        $studentsCount  = Student::count();
        $classesCount   = SchoolClass::count();
        $schedulesCount = Schedule::count();

        return view('admin.dashboard', compact('parentsCount', 'studentsCount', 'classesCount', 'schedulesCount'));
    }

    // Manage parent accounts
    public function manageParents()
    {
        $parents = User::whereHas('role', fn($q) => $q->where('name', 'parent'))->get();
        return view('admin.parents.index', compact('parents'));
    }

    // Manage student records
    public function manageStudents()
    {
        $students = Student::with('parent')->get();
        return view('admin.students.index', compact('students'));
    }

    // Manage class offerings
    public function manageClasses()
    {
        $classes = SchoolClass::all();
        return view('admin.classes.index', compact('classes'));
    }

    // Manage schedule slots
    public function manageSchedules()
    {
        $schedules = Schedule::with('schoolClass')->get();
        return view('admin.schedules.index', compact('schedules'));
    }

    // Show reporting interface
    public function showReports()
    {
        return view('admin.reports.index');
    }

    // Show announcement form
    public function showAnnouncementForm()
    {
        return view('admin.announcements.create');
    }

    // Post announcement to all parents via email/SMS
    public function postAnnouncement(Request $request)
    {
        $data = $request->validate([
            'message' => 'required|string',
        ]);

        $parents = User::whereHas('role', fn($q) => $q->where('name', 'parent'))->get();
        Notification::send($parents, new AnnouncementNotification($data['message']));

        return redirect()->back()->with('status', 'Announcement sent.');
    }
}
