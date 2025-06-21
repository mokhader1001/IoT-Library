<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::user_log');

// Public routes (no login required)
$routes->get('Admin', 'Auth::index');
$routes->post('auth/login', 'Auth::login');

// Protected routes (require login)
$routes->group('', ['filter' => 'authguard'], function ($routes) {
    $routes->get('body', 'Home::body');
    $routes->get('Authors', 'Home::Authors');
    $routes->post('authors/save', 'Home::author_form');
    $routes->get('authors/fetch_Authors', 'Home::fetch_Authors');
    $routes->get('logout', 'Auth::logout');
    $routes->get('lib', 'Home::lib');
    $routes->post('libraryusers/save', 'Home::save_lib'); // Insert/Update/Delete user

    $routes->get('authors/fetch_library_users', 'Home::fetch_lib_users');

    $routes->get('books', 'Home::books');
    $routes->post('books/save', 'Home::save_book'); 
    $routes->get('books/fetch_books', 'Home::fetch_books');

    $routes->get('staff/users', 'Home::lib_staf');
    $routes->get('staff/fetch_staff', 'Home::fetch_staff');

    $routes->post('staff/save_staff', 'Home::save_staff'); 

    $routes->get('libaray/rules', 'Home::rules');

    $routes->get('user/view_profile', 'Home::profile');

    $routes->get('finance/charges', 'Home::viewDamage');

    $routes->get('get_damaged_books_pending_charge', 'Home::get_damaged_books_pending_charge');


    $routes->post('charges/evaluate', 'Home::evaluate');


    $routes->get('Admin/loginLogs', 'Home::loginLogs');

    $routes->get('cancel_cahrge', 'Home::cancel_charge');

    $routes->get('charges/fetch_damage_charges', 'Home::fetch_damage_charges');
    $routes->post('charges/delete_damage_charge', 'Home::delete_damage_charge');
    $routes->post('makepayment', 'Home::makepayment');
    $routes->get('finance/payment', 'Home::payment_report');
    $routes->get('payment/export_pdf', 'Home::export_pdf');
    $routes->get('finance/expenses', 'Home::exp_tpes');
    $routes->get('expense_type/fetch_expense_types', 'Home::fetch_expense_types');
    $routes->post('expense_type/save_expense_type', 'Home::save_expense_type');
    $routes->get('finance', 'Home::fetch_expense_types');
    $routes->get('fetch_expense_payments', 'Home::fetch_expense_payments');
    $routes->post('save_expense_payment', 'Home::save_expense_payment');
    $routes->get('fetch_all_transactions', 'Home::fetch_all_transactions');
















    













});
$routes->get('user/verfications', 'Home::verfications');

$routes->post('checkCardId', 'Home::checkCardId');

$routes->post('sendVerificationCode', 'Home::sendVerificationCode'); 


$routes->get('dhash', 'Home::dhash');

$routes->post('verifyCode', 'Home::verifyCode');

$routes->get('borrow', 'Home::showAvailableBooks');

$routes->post('borrow/save', 'Home::saveBorrow');

$routes->post('library-policy/save', 'Home::save');


$routes->get('fetch_borrow_book', 'Home::fetch_borrow_booka');

$routes->get('return', 'Home::return');


$routes->post('returnbooks', 'Home::returnbooks');

$routes->get('Dash', 'Home::Dash');
$routes->get('Rules_for_Users', 'Home::Rules_for_Users');

$routes->get('showUnreturnedBooks', 'Home::showUnreturnedBooks');







