<?php

use Scu\Models\Member;
use Scu\Forms\MemberRegistration;
use Scu\Forms\MemberEdit;
use Scu\Forms\VerificationCodeReset;
use Scu\Exceptions\InvalidConfirmationCodeException;
use Scu\Forms\FormValidationException;

class MembersController extends BaseController
{
    protected $registrationForm;
    protected $editForm;
    protected $verificationCodeForm;

    public function __construct(MemberRegistration $registrationForm, MemberEdit $editForm, VerificationCodeReset $verificationCodeForm)
    {
        $this->registrationForm = $registrationForm;
        $this->editForm = $editForm;
        $this->verificationCodeForm = $verificationCodeForm;
    }


    /**
     *
     *
     * @return Response
     */
    public function admin()
    {
        $limit = min(Input::get('limit', 25), 25);

        $users = User::paginate($limit);

        // return View::make('admin.view')->withUsers($users);

        $usersTable = Datatable::table()
          ->addColumn('Name', 'Title', 'Created', 'View')
          ->setUrl(route('users.datatables'))
          ->noScript();

        $presentationsTable = Datatable::table()
          ->addColumn('Title', 'Description', 'Owner', 'Public', 'Locked', 'Config', 'Viewed', 'Created', 'View')
          ->setUrl(route('presentations.datatables'))
          ->noScript();

        $teamsTable = Datatable::table()
          ->addColumn('Name', 'Description', 'Organization', 'Created', 'View')
          ->setUrl(route('teams.datatables'))
          ->noScript();

        // $organizationsTable = Datatable::table()
        //   ->addColumn('Name', 'Title', 'Created', 'View')
        //   ->setUrl(route('users.datatables'))
        //   ->noScript();

        return View::make('admin.view', array('usersTable' => $usersTable, 'presentationsTable' => $presentationsTable, 'teamsTable' => $teamsTable, 'users' => $users));
    }

    // ### Remove ###
    // public function testJson($id)
    // {
    //     $user = Auth::user()->toJson();
    //     $apiKey = Session::get('apiKey');
    //     $presentation = Presentation::findOrFail($id);
    //     $slides = Presentation::findOrFail($id)->slides->toJson();
    //     return View::make('testJson', array('user' => $user, 'presentation' => $presentation, 'slides' => $slides, 'apiKey' => $apiKey));
    // }
    // ##############

    /**
     *
     *
     * @return Response
     */
    public function datatables()
    {

    $query = User::select('id','name','title', 'created_at')->get();
    return Datatable::collection($query)
        ->addColumn('name', function($model){
            return $model->name;
        })
        ->addColumn('title', function($model){
            return ucFirst($model->title);
        })
        ->addColumn('created_at', function($model){
            return date('M j, Y h:i A', strtotime($model->created_at));
        })
        ->addColumn('id', function($model){
            return '<a href="/users/' . $model->id . '">view</a>';
        })
        ->searchColumns('name')
        ->orderColumns('name', 'title')
        ->make();
    }

    /**
     *
     *
     * @return Response
     */
    public function index()
    {
        $limit = min(Input::get('limit', 25), 25);

        $users = User::paginate($limit);

        return View::make('users.list')->withUsers($users);
    }

    /**
     * Show the create form
     *
     * @return View
     */
    public function create()
    {
        return View::make('members.create');
    }

    public function register()
    {
        try
        {
            $this->registrationForm->validate(Input::all());
        }
        catch(FormValidationException $e)
        {
            //set up flash error message
            Flash::error('There were errors. Please see below.');

            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        $member = new Member(Input::all());

        $member['email'] = Input::get('email');
        $member['password'] = Hash::make(Input::get('password'));
        $member['confirmation_code'] = str_random(32);

        if (! $member->save() ){
            //set up flash error message
            Flash::error('There were errors. Please see below.');

            return Redirect::back()->withInput()->withErrors($member->getErrors());
        }

        $data = $member->toArray();

        Mail::send('emails.welcome', $data, function($message) use ($member)
        {
            // Note: should just use laravel global 'from' address in config
            $message->from('no-reply@sculty.com', 'Space City Ultimate');

            $message->to($member->email);

            $message->subject('Welcome to SCU!');
        });

        // // Alert email, if you want to be notified upon new registrations
        // Mail::send(array('text' => 'emails.alert.registration'), $data, function($message)
        // {
        //     $message->to('asifm42@gmail.com');
        //     $message->subject('New user registration');
        // });

        // set up flash success message
        Flash::success('Your account has been created. Please verify your account by clicking the verification link in the welcome email.');
        return Redirect::to('signin');
    }

    protected function verify($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            throw new InvalidConfirmationCodeException;
        }

        $member = Member::whereConfirmationCode($confirmation_code)->first();

        if ( ! $member)
        {
            throw new InvalidConfirmationCodeException;
        }

        $member->confirmed = 1;
        $member->confirmation_code = null;
        $member->save();

        // set up flash success message
        Flash::success('You have successfully verified your account.');

        return Redirect::route('sessions.signin');
    }

    protected function resetVerificationCodeForm()
    {
        return View::make('auth.verify');
    }

    protected function resetVerificationCode()
    {
        try
        {
            $this->verificationCodeForm->validate(Input::all());
        }
        catch(FormValidationException $e)
        {
            //set up flash error message
            Flash::error('There were errors. Please see below.');

            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        $user = User::whereEmail(Input::get('email'))->first();

        if ( ! $user)
        {
            Flash::error('We could not find that account!');

            return Redirect::back()->withInput();
        }

        if ($user->confirmed === 1){
            Flash::warning('Your account is already verified!');

            return Redirect::to('signin');
        }

        $user['confirmation_code'] = str_random(32);

        $user->save();

        $data = $user->toArray();

        Mail::send('emails.welcome', $data, function($message) use ($user)
        {
            $message->from('admin@obsidian.black', 'Admin');

            $message->to($user->email);

            $message->subject('Welcome to Obsidian Black');
        });

        // set up flash success message
        Flash::success('Welcome email resent! Please verify your account by clicking the verification link in the welcome email.');

        return Redirect::to('signin');
    }

    /**
     * Retrieve a single User
     * @param type $id
     * @return View
     */
    public function show($id)
    {
        $member = Member::findOrFail($id);

        $data['member']  = $member;

        return View::make('members.dashboard', $data);
    }

    public function edit($id)
    {
        // create a form should have email as disabled.
        $member = Member::findOrFail($id);

        return View::make('members.edit')->withMember($member);
    }

    public function update($id)
    {
        try
        {
            $this->editForm->validate(Input::all());
        }
        catch(FormValidationException $e)
        {
            //set up flash error message
            Flash::error('There were errors. Please see below.');

            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        $member = Member::findOrFail($id);

        $member->fill(Input::all());

        if ( ! $member->save() ) {
            //set up flash error message
            Flash::error('There were errors. Please see below.');

            return Redirect::back()->withInput()->withErrors($member->getErrors());
        }


        Flash::success('Update Saved');

        return $this->show(Auth::user()->id);
    }

    /**
     * Soft delete the resource (update deleted_at field)
     *
     * @param  int  $id
     * @return View
     */
    public function destroy($id)
    {
        //soft delete the user and redirect to ?
    }

    public function dashboard()
    {
        return $this->show(Auth::user()->id);
    }

    public function settings()
    {
        $user = Auth::user();
        $data['user'] = $user;

        return View::make('users.settings', $data );
    }
}