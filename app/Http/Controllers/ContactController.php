<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Services\ContactService;

class ContactController extends Controller
{
    public function store(StoreContactRequest $request)
    {
       return (new ContactService())->store($request);
    }
}
