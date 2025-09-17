<?php

return array (
  'fields' => 
  array (
    'email' => 
    array (
      'label' => 'Email',
      'placeholder' => 'Enter your email',
      'help' => 'Enter the email address you used to register',
      'description' => 'Email address for login',
    ),
    'password' => 
    array (
      'label' => 'Password',
      'placeholder' => 'Enter your password',
      'help' => 'Enter your account password',
      'description' => 'Password for login',
      'helper_text' => 'password',
    ),
    'remember' => 
    array (
      'label' => 'Remember me',
      'placeholder' => 'Keep session active',
      'help' => 'Select to keep your session active for 30 days',
      'description' => 'Option to remember login',
      'helper_text' => 'remember',
    ),
  ),
  'actions' => 
  array (
    'login' => 
    array (
      'label' => 'Login',
      'tooltip' => 'Click to access your account',
    ),
  ),
  'messages' => 
  array (
    'login_success' => 'Login successful',
    'login_error' => 'Error during login',
    'validation_error' => 'Validation error',
    'credentials_incorrect' => 'Incorrect credentials',
  ),
  'ui' => 
  array (
    'login_button' => 'Login',
    'forgot_password' => 'Forgot password?',
    'errors_title' => 'Some errors occurred',
  ),
);
