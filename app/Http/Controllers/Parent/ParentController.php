<?php
namespace App\Http\Controllers\Parent;
// app/Http/Controllers/Parent/ParentController.php
use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentController extends Controller
{
    // Parent dashboard overview
    public function dashboard()
    {
        $parent           = Auth::user();
        $studentsCount    = $parent->students()->count();
        $enrollmentsCount = Enrollment::whereIn('student_id', $parent->students()->pluck('id'))->count();

        return view('parent.dashboard', compact('parent', 'studentsCount', 'enrollmentsCount'));
    }

    // View & update own profile
    public function showProfile()
    {
        $parent = Auth::user();
        return view('parent.profile', compact('parent'));
    }

    public function updateProfile(Request $request)
    {
        $parent = Auth::user();
        $data   = $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $parent->id,
        ]);

        $parent->update($data);
        return redirect()->route('parent.profile')->with('status', 'Profile updated.');
    }

    // Browse available schedules
    public function listSchedules()
    {
        $schedules = Schedule::with('schoolClass')->get();
        return view('parent.schedules.index', compact('schedules'));
    }

    // Enroll a child in a schedule
    public function enroll(Request $request)
    {
        $data = $request->validate([
            'student_id'  => 'required|exists:students,id',
            'schedule_id' => 'required|exists:schedules,id',
        ]);

        Enrollment::create([
            'student_id'    => $data['student_id'],
            'schedule_id'   => $data['schedule_id'],
            'payment_status'=> 'pending',
        ]);

        return redirect()->back()->with('status', 'Enrollment successful (pending payment).');
    }

    // View own enrollments
    public function myEnrollments()
    {
        $parent      = Auth::user();
        $enrollments = Enrollment::with(['student', 'schedule.schoolClass'])
            ->whereIn('student_id', $parent->students()->pluck('id'))
            ->get();

        return view('parent.enrollments.index', compact('enrollments'));
    }
}

