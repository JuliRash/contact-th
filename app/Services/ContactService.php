<?php

namespace App\Services;
use App\Models\Contact;
use Symfony\Component\HttpFoundation\Response;


class ContactService {

    /**
     * store new contact
     * @param $request Request
     */
    public function store($request) : Response
    {
        $validated = $request->validated();

        $attachmentName = time() . uniqid('att_') . '.' . $request->attachment->extension();

        $request->attachment->move(public_path('attachments'), $attachmentName);

        $contact = Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'attachment' => $attachmentName,
            'message' => $validated['message'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'contact stored successfully.',
            'contact' => $contact
        ], Response::HTTP_CREATED);
    }
}
