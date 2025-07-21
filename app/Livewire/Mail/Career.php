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
        Mail::html($this->buildMessage(), function ($msg) use ($cvPath) {
            $msg->to(['vasim@shannoneng.com', 's.subhash@shannoneng.com']) // array of emails
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
    <h2 style="color:#2e6c80; font-family:Arial, sans-serif;">New Job Application Received</h2>
    
    <table cellpadding="8" cellspacing="0" border="0" style="font-family:Arial, sans-serif; border-collapse: collapse; width:100%; max-width:600px;">
        <tr>
            <td style="font-weight:bold;">Name:</td>
            <td>{$this->first_name} {$this->last_name}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;">Email:</td>
            <td>{$this->email}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;">Phone:</td>
            <td>{$this->contact_number}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;">Age:</td>
            <td>{$this->age}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;">Nationality:</td>
            <td>{$this->nationality}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;">Experience:</td>
            <td>{$this->experience}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;">Position Applied For:</td>
            <td>{$jobTitle}</td>
        </tr>
    </table>
    
    <h3 style="margin-top:30px; font-family:Arial, sans-serif;">Cover Letter</h3>
    <p style="padding: 10px; background-color:#f9f9f9; border-left:4px solid #2e6c80; font-family:Arial, sans-serif;">
        {$this->cover_letter}
    </p>
    
    <hr style="margin-top: 30px;">
    <p style="font-size: 12px; color: #777; font-family:Arial, sans-serif;">
        Application submitted via <strong>Shannon Engineering Careers Portal</strong>.
    </p>
    EOT;
    }

    public function render()
    {
        return view('livewire.mail.career');
    }
}
