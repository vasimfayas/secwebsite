<?php

namespace App\Livewire\Mail;

use Livewire\Component;

use Illuminate\Support\Facades\Mail;

class Contact extends Component
{
    public $first_name, $last_name, $email, $phone, $project_type, $message;


    public function submit()
    {

        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'project_type' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Send mail
        Mail::raw($this->buildMessage(), function ($msg) {
            $msg->to('vasim@shannoneng.com') // change this to your receiving email
                ->subject('New Project Inquiry from ' . $this->first_name . ' ' . $this->last_name);
        });

        session()->flash('success', 'Your message has been sent!');
        $this->reset(['first_name', 'last_name', 'email', 'phone', 'project_type', 'message']);
    }

    protected function buildMessage()
    {
        return <<<EOT
New Project Inquiry

Name: {$this->first_name} {$this->last_name}
Email: {$this->email}
Phone: {$this->phone}
Project Type: {$this->project_type}

Message:
{$this->message}
EOT;
    }

    public function render()
    {
        return view('livewire.mail.contact');
    }
}
