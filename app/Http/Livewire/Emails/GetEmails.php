<?php

namespace App\Http\Livewire\Emails;

use App\Jobs\SendEmailsJob;
use App\Mail\ConferenceMail;
use App\Models\Email;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class GetEmails extends Component
{
    public $emails;
    public $list = [];
    public $checked_emails;
    public $group;
    public $selected = false;
    public function render()
    {
        return view('livewire.emails.get-emails')->extends('layouts.app');
    }

    public function mount()
    {
        $this->emails = Email::query()->oldest()->get();
    }

    public function updated($field)
    {
        if($this->group == "")
        {
            return;
        }

        if($this->group !== "")
        {
            $this->emails = Email::query()->where('user_group', $this->group)->latest()->get();
        }

    }

    public function RemoveEmail($id)
    {
        try
        {
            if(Email::query()->find($id)->delete())
            {
                if($this->group !== "")
                {
                    $this->emails = Email::query()->where('user_group', $this->group)->latest()->get();
                }
                else {
                    $this->emails = Email::query()->oldest()->get();
                }

                session()->flash('success', 'Email have been successfully deleted');
            }

        }catch (\Exception $ex)
        {
            Log::info($ex);
        }
    }

    public function SendToGroup()
    {
        if($this->group == "")
        {
            session()->flash('error', 'Select group please!');
            return;
        }

        $data = [
            'subject' => 'ANNUAL TAX CONFERENCE INVITATION - 12 to 13 May 2021',
            'body' => 'Dear'
        ];
        $list =  $this->emails = Email::query()->where('user_group', $this->group)->latest()->get();
        if($list === null)
        {
            session()->flash('error', 'No Email selected to send');
            return;
        }
        $word = "/";
        foreach ($list as $member) {
            Log::info('Start Initiate Job');
            $value['email'] = $member->email;

            if($value['email'] === null)
            {
                continue;
            }
            if(strpos($value['email'], $word) !== false){
                $split_emails = explode( $word, $value['email']);
                $value['email'] = $split_emails[0];
            }
            $data['name'] = $member->name;
            SendEmailsJob::dispatch($value['email'], $data);
            Log::info($data);
            Log::info('End Job Initiation');
        }
        session()->flash('success', 'Group name : '.$this->group.' ! Emails have been successfully send to the whole group');
    }

    public function SendEmail()
    {
        /*$word = "/";
        $my_word = "I HATE SAMBA/I LOVE SAMBA";
        if(strpos($my_word, $word) !== false){
            $split_emails = explode($word, $my_word);
            Log::info($split_emails[0]);
            Log::info($split_emails[1]);
        }

        return;*/

        $data = [
            'subject' => 'ANNUAL TAX CONFERENCE INVITATION - 12 to 13 May 2021',
            'body' => 'Dear',
            'name' => 'Dylan'
        ];
        $list = $this->checked_emails;
        if($list === null)
        {
            session()->flash('error', 'No Email selected to send');
            return;
        }
        $word = "/";
        foreach ($list as $key => $value) {
            Log::info('Start Initiate Job');
            $id = $value['id'];
            $user = Email::query()->find($id);

            if($user->email === null)
            {
                continue;
            }
            if(strpos($user->email, $word) !== false){
                $split_emails = explode( $word, $user->email);
                $user->email = $split_emails[0];
            }
            $data['name'] = $user->name;
            SendEmailsJob::dispatch($user->email, $data);
            Log::info('End Job Initiation');
        }
        session()->flash('success', 'Emails have been successfully send');

    }

    public function AddEmail($id)
    {
        $mail = Email::query()->find($id);
        $this->list += $mail->email;
        Log::info($this->list);
    }


}
