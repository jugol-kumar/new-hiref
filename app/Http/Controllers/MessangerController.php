<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\MessageDetail;
use App\Models\MessageInfo;
use Chatify\Facades\ChatifyMessenger as Chatify;
use Chatify\Http\Controllers\MessagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class MessangerController extends MessagesController
{
    public function send(Request $request)
    {

        MessageDetail::updateOrCreate([
            'job_id' => $request->job_id,
            'recruiter_id' => $request->rec_id,
            'seeker_id' => Auth::id()
        ]);

        $job = Job::findOrFail($request->job_id);
//        $mainMessage = html_entity_decode('<a href="'.URL::route('client.single_job', $job->slug).'">'.URL::route('client.single_job', $job->slug).'</a>');

        $mainMessage = "This is your initials message. Hi im ".\auth()->user()->name.". I Will Apply For ".$job->title." this is your job title";
        // default variables
        $error = (object)[
            'status' => 0,
            'message' => null
        ];
        $attachment = null;
        $attachment_title = null;

        // if there is attachment [file]
        if ($request->hasFile('file')) {
            // allowed extensions
            $allowed_images = Chatify::getAllowedImages();
            $allowed_files  = Chatify::getAllowedFiles();
            $allowed        = array_merge($allowed_images, $allowed_files);

            $file = $request->file('file');
            // check file size
            if ($file->getSize() < Chatify::getMaxUploadSize()) {
                if (in_array(strtolower($file->getClientOriginalExtension()), $allowed)) {
                    // get attachment name
                    $attachment_title = $file->getClientOriginalName();
                    // upload attachment and store the new name
                    $attachment = Str::uuid() . "." . $file->getClientOriginalExtension();
                    $file->storeAs(config('chatify.attachments.folder'), $attachment, config('chatify.storage_disk_name'));
                } else {
                    $error->status = 1;
                    $error->message = "File extension not allowed!";
                }
            } else {
                $error->status = 1;
                $error->message = "File size you are trying to upload is too large!";
            }
        }

        if (!$error->status) {


//            return $request;

            // send to database
            $messageID = mt_rand(9, 999999999) + time();
            $messageInfo = Chatify::newMessage([
                'id' => $messageID,
                'type' => $request['type'],
                'from_id' => Auth::user()->id,
                'to_id' => $request['rec_id'],
                'job_id' => $request['job_id'],
                'body' => htmlentities(trim($mainMessage), ENT_QUOTES, 'UTF-8'),
                'attachment' => ($attachment) ? json_encode((object)[
                    'new_name' => $attachment,
                    'old_name' => htmlentities(trim($attachment_title), ENT_QUOTES, 'UTF-8'),
                ]) : null,
            ]);


            MessageInfo::create([
               'message_id' => $messageID,
                'recruiter_id' => $request['rec_id'],
                'seeker_id' => $request['send_id'],
                'job_id' => $request['job_id']
            ]);

            // fetch message to send it with the response
            $messageData = Chatify::fetchMessage($messageID);

            // send to user using pusher
            Chatify::push("private-chatify.".$request['id'], 'messaging', [
                'from_id' => Auth::user()->id,
                'to_id' => $request['id'],
                'job_id' => $request['job_id'],
                'message' => Chatify::messageCard($messageData, 'default')
            ]);
        }

        return redirect()->route('user', $request->send_id);
    }
}
