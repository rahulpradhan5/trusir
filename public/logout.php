<?php

// Load the Laravel application
require __DIR__ . '/../bootstrap/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Http\Kernel::class)->handle(Illuminate\Http\Request::capture());

// Destroy the mobile session
session()->forget('mobile');

// Redirect the user to the login page
return redirect()->route('Login');
