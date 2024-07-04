<?php /* Template Name: Test Formidable Template */ ?>

<?php
session_start();
include('vendor/autoload.php');

// Formidable will parse the form and use it to check integrity on the server-side
$form_path = get_template_directory() . '/forms/example.html';
$form = new Gregwar\Formidable\Form($form_path);

$form->handle(function() {
    echo "Form OK!";
}, function($errors) {
    echo "Errors: <br/>";
    foreach ($errors as $error) {
        echo "$error<br />";
    }
});

echo $form;

// Will set the value of the field
// $form->name = "Bob";

// Will get the value of the field
$name = $form->name;

// Adds a constraint on the name
$form->addConstraint('name', function($value) {
    if (strlen($value) < 10) {
        return 'Your name should be at least 10 characters!';
    }
});

// Adds a constraint on the whole form
$form->addConstraint(function($form) {
    if ($form->getValue('pass1') != $form->getValue('pass2')) {
        return 'The passwords are different';
    }
});