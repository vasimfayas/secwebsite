<?php

namespace App\Livewire\Mail;

use Livewire\Component;

use Illuminate\Support\Facades\Mail;

class Contact extends Component
{
    public $first_name, $last_name, $email, $phone, $message;


    public function submit()
    {

        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'message' => 'required|string|max:2000',
        ]);

        // Send mail
        Mail::html($this->buildMessage(), function ($msg) {
            $msg->to('vasim@shannoneng.com')
                ->subject('New Project Inquiry from ' . $this->first_name . ' ' . $this->last_name);
        });

        session()->flash('success', 'Your message has been sent!');
        $this->reset(['first_name', 'last_name', 'email', 'phone', 'message']);
    }

    protected function buildMessage()
    {
        return <<<EOT
<h2 style="color:#2e6c80;">New Project Inquiry Received</h2>
<table cellpadding="8" cellspacing="0" border="0" style="font-family:Arial, sans-serif; border-collapse: collapse;">
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
        <td>{$this->phone}</td>
    </tr>
    <tr>
        <td style="font-weight:bold; vertical-align: top;">Message:</td>
        <td>{$this->message}</td>
    </tr>
</table>
<hr style="margin-top: 20px;">
<p style="font-size: 12px; color: #777;">This is an automated message from your website. Please do not reply to this email directly.</p>
EOT;
    }

    public function render()
    {
        return view('livewire.mail.contact');
    }
}
