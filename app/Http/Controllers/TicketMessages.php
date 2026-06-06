<?php

namespace App\Http\Controllers;

use App\Mail\TicketCreatedMail;
use App\Mail\TicketReplyMail;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TicketMessages extends Controller
{
    public function addTicket(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $ticket = Ticket::create([
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'status' => 'open',
        ]);

        TicketMessage::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        $admins = User::where('user_type_id', 1)->get(); // 1 = admin

        foreach ($admins as $admin) {
            Mail::to($admin->email)->queue(new TicketCreatedMail($ticket));
        }
        return back()->with('success', [__('messages.ticket_opened')]);
    }

    public function reply(Request $request, Ticket $ticket)
    {
        $request->validate(['message' => 'required|string']);

        TicketMessage::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(), // المدير أو المستخدم
            'message' => $request->message,
        ]);


        // ممكن تحديث الحالة
        if ($ticket->status == 'open') {
            $ticket->update(['admin_id' => Auth::id(), 'status' => 'in_progress']);
        }
        $email = $request->type == '0' ? $ticket->admin->email : $ticket->user->email;


        Mail::to($email)->send(new TicketReplyMail($ticket, $request->type));
        return back()->with('success', [__('messages.ticket_reply_sent_user')]);
    }

}
