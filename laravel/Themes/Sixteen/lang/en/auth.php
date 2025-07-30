<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines - Sixteen Theme
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    // General authentication messages
    'failed' => 'These credentials do not match our records.',
    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'general_error' => 'An error occurred. Please try again later.',
    'unauthorized' => 'You do not have the necessary permissions for this operation.',

    // Login
    'login' => [
        'title' => 'Sign in',
        'email' => 'Email',
        'password' => 'Password',
        'remember_me' => 'Remember me',
        'forgot_password' => 'Forgot your password?',
        'submit' => 'Sign in',
        'or' => 'or',
        'create_account' => 'create an account',
        'link' => 'Sign in',
        'success' => 'Login successful',
        'error' => 'Login error',
        'error_message' => 'An error occurred during login. Please try again later.',
        'validation_error' => 'Validation error',
        'invalid_credentials' => 'The provided credentials are incorrect.',
    ],

    // Register
    'register' => [
        'title' => 'Register',
        'name' => 'Name',
        'email' => 'Email',
        'password' => 'Password',
        'password_confirmation' => 'Confirm Password',
        'submit' => 'Register',
        'already_registered' => 'Already have an account?',
        'link' => 'Register',
    ],

    // Logout
    'logout' => [
        'title' => 'Logout',
        'confirm_message' => 'Are you sure you want to logout?',
        'confirm_button' => 'Confirm Logout',
        'cancel_button' => 'Cancel',
        'success_title' => 'Logged Out',
        'success_message' => 'You have been successfully logged out.',
        'error_title' => 'Logout Error',
        'error_message' => 'An error occurred during logout.',
        'try_again' => 'Try Again',
        'back_to_home' => 'Back to Home',
    ],

    // Profile
    'profile' => [
        'title' => 'Profile',
        'settings' => 'Settings',
        'information' => 'Profile Information',
        'update_password' => 'Update Password',
        'current_password' => 'Current Password',
        'new_password' => 'New Password',
        'confirm_password' => 'Confirm Password',
        'save' => 'Save',
        'update' => 'Update',
    ],

    // Reset Password
    'reset' => [
        'title' => 'Reset Password',
        'email' => 'Email',
        'password' => 'New Password',
        'password_confirmation' => 'Confirm Password',
        'submit' => 'Reset Password',
        'link_sent' => 'We have emailed your password reset link!',
        'reset_link' => 'Reset Password',
    ],

    // Email Verification
    'verify' => [
        'title' => 'Verify Email',
        'message' => 'Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?',
        'resend' => 'If you didn\'t receive the email, we can resend it.',
        'submit' => 'Resend verification email',
    ],

    // Navigation
    'navigation' => [
        'open_menu' => 'Open main menu',
        'close_menu' => 'Close main menu',
        'home' => 'Home',
        'dashboard' => 'Dashboard',
        'profile' => 'Profile',
        'settings' => 'Settings',
    ],

    // User dropdown
    'user_dropdown' => [
        'manage_account' => 'Manage Account',
        'profile' => 'Profile',
        'settings' => 'Settings',
        'logout' => 'Logout',
        'login_link' => 'Sign in',
        'register_link' => 'Register',
    ],

    // Notification messages
    'notifications' => [
        'login_success' => 'Login successful',
        'login_error' => 'Login error',
        'logout_success' => 'Logout successful',
        'logout_error' => 'Logout error',
        'validation_error' => 'Validation error',
        'general_error' => 'An error occurred. Please try again later.',
    ],
]; 