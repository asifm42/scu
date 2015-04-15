<?php



class UsersTest extends ApiTester {

    use Factory;

    // Tesing procedure: Arrange -> Act -> Assert

    /** @test */
    public function it_fetches_users()
    {
        $this->make('User');

        $this->getJson('users');

        $this->assertResponseOk();
    }

    /** @test */
    public function it_fetches_a_single_user()
    {
        $this->make('User');

        $user = $this->getJson('users/1')->data;

        $this->assertResponseOk();
        $this->assertObjectHasAttributes($user, 'email', 'title', 'first_name', 'last_name');
    }

    /** @test
     *
     *  @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function it_throws_a_ModelNotFoundException_if_a_user_is_not_found()
    {
        $this->getJson('users/x');
    }

    /** @test */
    public function it_creates_a_new_user_given_valid_parameters()
    {
        $user = $this->getJson('users', 'POST', $this->getStub())->data;

        $this->assertResponseStatus(201);
        $this->assertObjectHasAttributes($user, 'email', 'title', 'first_name', 'last_name');
    }

    // /** @test */
    // public function it_throws_a_422_if_a_new_lesson_request_fails_validation()
    // {
    //     $this->getJson('api/v1/lessons', 'POST');

    //     $this->assertResponseStatus(422);
    // }

    protected function getStub()
    {
        return [
            'email'     => $this->fake->email,
            'first_name'=> $this->fake->word,
            'last_name' => $this->fake->word,
            'title'     => $this->fake->sentence,
            'password'  => Hash::make($this->fake->word),
        ];
    }

}