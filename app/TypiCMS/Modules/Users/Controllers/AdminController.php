<?php
namespace TypiCMS\Modules\Users\Controllers;

use App;
use Config;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Message;
use Input;
use Mail;
use Notification;
use Redirect;
use TypiCMS\Controllers\AdminSimpleController;
use TypiCMS\Modules\Users\Repositories\UserInterface;
use TypiCMS\Modules\Users\Services\Form\UserForm;
use View;

class AdminController extends AdminSimpleController
{

    /**
     * __construct
     *
     * @param UserInterface $user
     * @param UserForm      $userform
     */
    public function __construct(UserInterface $user, UserForm $userform)
    {
        parent::__construct($user, $userform);
        $this->title['parent'] = trans_choice('users::global.users', 2);
    }

    public function getLogin()
    {
        $this->layout->content = View::make('users.admin.login');
    }

    public function postLogin()
    {
        $credentials = array(
            'email'    => Input::get('email'),
            'password' => Input::get('password')
        );

        try {
            $user = $this->repository->authenticate($credentials, false);
            Notification::success(
                trans('users::global.Welcome', array('name' => $user->first_name))
            );

            return Redirect::intended('/');
        } catch (Exception $e) {
            Notification::error($e->getMessage());

            return Redirect::route('login')->withInput();
        }
    }

    public function getLogout()
    {
        $this->repository->logout();
        Notification::success(trans('users::global.You are logged out'));

        return Redirect::back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->title['child'] = trans('users::global.New');
        $model = $this->repository->getModel();
        $this->layout->content = View::make('admin.create')
            ->withModel($model)
            ->with('selectedGroups', array())
            ->with('groups', $this->repository->getGroups());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Model      $model
     * @return Response
     */
    public function edit(Model $model)
    {
        $this->title['child'] = trans('users::global.Edit');
        $this->layout->content = View::make('admin.edit')
            ->withModel($model)
            ->withPermissions($model->getPermissions())
            ->withGroups($this->repository->getGroups())
            ->with('selectedGroups', $this->repository->getGroups($model));

    }

    /**
     * Get registration form.
     *
     * @return Response
     */
    public function getRegister()
    {
        // Show the register form
        $this->layout->content = View::make('users.admin.register');
    }

    /**
     * Register a new user.
     *
     * @return Response
     */
    public function postRegister()
    {

        if (! $this->form->valid(Input::all())) {
            return Redirect::route('register')
                ->withInput()
                ->withErrors($this->form->errors());
        }
        // confirmation
        $noConfirmation = null;

        try {

            $input = Input::except('password_confirmation');
            $this->repository->register($input, $noConfirmation);
            $message = 'Your account has been created, ';
            $message .= $noConfirmation ? 'you can now log in' : 'check your email for the confirmation link' ;
            Notification::success(trans('users::global.'.$message));

            return Redirect::route('login');

        } catch (Exception $e) {

            Notification::error($e->getMessage());

            return Redirect::route('register')->withInput();

        }

    }

    /**
     * Activate a new User
     */
    public function getActivate($userId = null, $activationCode = null)
    {
        try {
            $this->repository->activate($userId, $activationCode);
            Notification::success(trans('users::global.Your account has been activated, you can now log in'));
        } catch (Exception $e) {
            Notification::error($e->getMessage());
        }

        return Redirect::route('login');

    }

    /**
     * Forgot Password / Reset
     */
    public function getResetpassword()
    {
        // Show the reset password form
        $this->layout->content = View::make('users.admin.reset');
    }

    public function postResetpassword()
    {
        if (! $this->form->resetPasswordValid(Input::all())) {
            return Redirect::route('resetpassword')
                ->withInput()
                ->withErrors($this->form->errors());
        }

        try {
            $email = Input::get('email');
            $user = $this->repository->findUserByLogin($email);
            $data = array();
            $data['resetCode'] = $this->repository->getResetPasswordCode($user);
            $data['userId'] = $this->repository->getId($user);
            $data['email'] = $email;

            // Email the reset code to the user
            Mail::send('emails.auth.reset', $data, function (Message $message) use ($data) {
                $subject  = '[' . Config::get('typicms.' . App::getLocale() . '.websiteTitle') . '] ';
                $subject .= trans('users::global.Password Reset Confirmation');
                $message->to($data['email'])->subject($subject);
            });

            Notification::success(trans('users::global.An email was sent with password reset information'));

            return Redirect::route('login');

        } catch (Exception $e) {
            Notification::error($e->getMessage());

            return Redirect::route('resetpassword')->withInput();
        }

    }

    /**
     * Change User's password
     */
    public function getChangepassword($userId = null, $resetCode = null)
    {
        try {
            // Find the user
            $user = $this->repository->byId($userId);
            if (! $this->repository->checkResetPasswordCode($user, $resetCode)) {
                Notification::error(trans('users::global.This password reset token is invalid'));
                return Redirect::route('login');
            }
            $data = array();
            $data['id'] = $userId;
            $data['resetCode'] = $resetCode;

            $this->layout->content = View::make('users.admin.newpassword')
                ->with($data);

        } catch (Exception $e) {
            Notification::error(trans('users::global.User does not exist'));
            return Redirect::route('login');
        }

    }


    /**
     * Change User's password
     */
    public function postChangepassword()
    {
        $input = Input::all();

        if (! $this->form->changePasswordValid($input)) {
            return Redirect::route('changepassword', array($input['id'], $input['resetCode']))
                ->withInput()
                ->withErrors($this->form->errors());
        }

        try {

            // Find the user
            $user = $this->repository->byId($input['id']);

            if ($this->repository->checkResetPasswordCode($user, $input['resetCode'])) {
                // Attempt to reset the user password
                if ($this->repository->attemptResetPassword($user, $input['resetCode'], $input['password'])) {

                    Notification::success(trans('users::global.Your password has been changed'));

                    try {
                        $credentials = array(
                            'email' => $user->getLogin(),
                            'password' => $input['password']
                        );
                        $this->repository->authenticate($credentials, false);

                        return Redirect::to('/');
                    } catch (Exception $e) {
                        Notification::error($e->getMessage());

                        return Redirect::route('login')->withInput();
                    }

                } else {
                    // Password reset failed
                    $msg = trans('users::global.There was a problem, please contact the system administrator');
                    Notification::success($msg);
                }
            } else {
                Notification::error(trans('users::global.This password reset token is invalid'));
            }
        } catch (Exception $e) {
            Notification::error($e->getMessage());
        }

        return Redirect::route('login');

    }

    /**
     * Update User's preferences
     */
    public function postUpdatePreferences()
    {
        $input = Input::all();
        $this->repository->updatePreferences($input);
    }
}
