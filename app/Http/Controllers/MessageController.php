<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role == 'imam') {
            $users = User::where('role', 'adherant')->get();
        } elseif ($user->role == 'adherant') {
            $users = User::where('role', 'imam')->get();
        } else {
            abort(403, 'Accès refusé');
        }

        // Pour chaque utilisateur, on ajoute le nombre de messages non lus envoyés à $user
        $users->map(function ($u) use ($user) {
            $u->unread_count = Message::where('sender_id', $u->id)
                ->where('receiver_id', $user->id)
                ->where('is_read', false)
                ->count();
            return $u;
        });

        // Afficher la vue correcte selon le rôle
        if ($user->role == 'imam') {
            return view('imam.messages', compact('users'));
        } else {
            return view('messages.index', compact('users'));
        }
    }



    public function show($id)
    {
        $receiver = User::findOrFail($id);
        $user = auth()->user();

        // Autorisation selon les rôles
        if (
            !($user->role === 'imam' && $receiver->role === 'adherant') &&
            !($user->role === 'adherant' && $receiver->role === 'imam')
        ) {
            abort(403, 'Messagerie réservée à imam <-> adhérent');
        }


        $messages = Message::where(function ($q) use ($user, $receiver) {
            $q->where('sender_id', $user->id)->where('receiver_id', $receiver->id);
        })->orWhere(function ($q) use ($user, $receiver) {
            $q->where('sender_id', $receiver->id)->where('receiver_id', $user->id);
        })->orderBy('created_at')->get();

        // Récupérer la liste des utilisateurs selon le rôle (même logique que index)
        if ($user->role == 'imam') {
            $users = User::where('role', 'adherant')->get();
        } elseif ($user->role == 'adherant') {
            $users = User::where('role', 'imam')->get();
        }

        return view('messages.chat', compact('messages', 'receiver', 'users'));    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $receiver = User::findOrFail($request->receiver_id);

        // Vérification des rôles
        if (
            !($user->role === 'imam' && $receiver->role === 'adherant') &&
            !($user->role === 'adherant' && $receiver->role === 'imam')
        ) {
            abort(403, 'Messagerie réservée à imam <-> adhérent');
        }

        // Validation
        $request->validate([
            'content' => 'required'
        ]);

        // Création du message
        $message = Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $receiver->id,
            'content' => $request->content,
        ]);

        // Déclenchement de l’événement en temps réel
        event(new MessageSent($message));

        return back()->with('success', 'Message envoyé');
    }
}
