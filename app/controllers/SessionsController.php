<?php

use Scu\Forms\Signin;
use Scu\Forms\FormValidationException;
use Chrisbjr\ApiGuard\ApiKey;
use Chrisbjr\ApiGuard\Transformers\ApiKeyTransformer;

class SessionsController extends BaseController
{
    protected $signinForm;

    public function __construct(Signin $signinForm)
    {
        $this->signinForm = $signinForm;
    }

    /**
     * Show the Sign In Form. If user is signed in then redirect to user dashboard
     *
     * @return View
     */
    public function create()
    {
        if (! Auth::check()) {
            return View::make('auth.login');
        }

        Flash::warning('You are already signed in.');

        return Redirect::to('dashboard');
    }

    public function signIn()
    {
        try
        {
            $this->signinForm->validate(Input::all());
        }
        catch(FormValidationException $e)
        {
            // Set up error flash message
            Flash::error('There were errors. Please see below.');

            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        //form has validated

        $credentials['email']       =  Input::get('email');
        $credentials['password']    =  Input::get('password');

        $rememberMe = ((Input::get('remember_me') === 'true') ? true : false);

        if (Auth::attempt($credentials, $rememberMe)) {

            //authenticate user in api and store the api key in the session
            //Session::put('apiKey', $this->getApiKey());

            // Set up success flash message
            Flash::success('<strong>Success!</strong> You have signed in.');

            return Redirect::to(route('members.dashboard'));
        }

        // Set up error flash message
        Flash::error('<strong>Try again!</strong> Your email or password was incorrect.');

        // redirect to login form
        return Redirect::to('signin')->withInput();
    }

    public function getApiKey()
    {
        if (Auth::check()) {

            // Assign an API key for this session
            $apiKey = ApiKey::where('user_id', '=', Auth::user()->id)->first();
            if (!isset($apiKey)) {
                $apiKey                = new ApiKey;
                $apiKey->user_id       = Auth::user()->id;
                $apiKey->key           = $apiKey->generateKey();
                $apiKey->level         = 5;
                $apiKey->ignore_limits = 0;
            } else {
                $apiKey->generateKey();
            }

            if (!$apiKey->save()) {
                return ("Fail");
            }

            //return the api_key
            return $apiKey;
        }

        return ("Fail");
    }

    public function signOut()
    {
        Auth::logout();

        // Set up success flash message
        Flash::success('<strong>Success!</strong> You have signed out. Have a nice day!');

        return Redirect::to('signin');
    }
















}