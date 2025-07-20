<?php

namespace App\Livewire\Mail;

use App\Models\Career as ModelsCareer;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class Career extends Component
{
    use WithFileUploads;
    public $job;
    public $job_id;
    public $cover_letter;

    public $first_name, $last_name, $age, $experience, $nationality, $email, $contact_number, $cv;


    public function updatedJobId($value)
    {
        $this->job = ModelsCareer::find($value)?->title ?? 'General application';
    }


    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'age' => 'required|numeric|min:18|max:65',
        'experience' => 'required|string|max:255',
        'nationality' => 'required|string|max:100',
        'email' => 'required|email|max:255',
        'contact_number' => 'required|string|max:20',
        'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        'cover_letter' => 'nullable|string|max:2000',

    ];

    public function submit()
    {
        $this->validate();

        // Save uploaded file
        $cvPath = $this->cv->store('careers');
        // fires event to Alpine

        // Store logic (e.g., DB insert or email) goes here
        Mail::raw($this->buildMessage(), function ($msg) use ($cvPath) {
            $msg->to(['hr@shannoneng.com', 'ibrahim@shannoneng.com']) // array of emails
                ->subject('New Application - ' . $this->job)
                ->attach(storage_path('app/' . $cvPath));
        });



        session()->flash('success', 'Your application has been submitted.');
        $this->reset();
        $this->dispatch('career-submitted');
        $this->dispatch('close-career-modal');
    }

    protected function buildMessage()
    {
        $jobTitle = is_string($this->job) ? $this->job : ($this->job->title ?? 'General Application');

        return <<<EOT
------------------------------------------------------------
                   JOB APPLICATION DETAILS
------------------------------------------------------------

Name           : {$this->first_name} {$this->last_name}
Email          : {$this->email}
Phone          : {$this->contact_number}
Age            : {$this->age}
Nationality    : {$this->nationality}
Experience     : {$this->experience}
Position Applied For: {$jobTitle}

------------------------------------------------------------
                    COVER LETTER
------------------------------------------------------------

{$this->cover_letter}

------------------------------------------------------------
Application submitted via Shannon Engineering Careers Portal
EOT;
    }

    public function render()
    {
        return view('livewire.mail.career');
    }
}
