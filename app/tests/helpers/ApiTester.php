<?php

use Faker\Factory as Faker;

// run phpunit from the command line with "vendor/bin/phpunit"

abstract class ApiTester extends TestCase {

    /**
     * @var Faker
     */
    protected $fake;

    /**
     * @var string Hold namespace prefix
     */
    protected $modelNamespace = '\Black\Models\\';

    /**
     * Initialize
     */
    function __construct($modelNamespace = '\Black\Models\\')
    {
        $this->fake = Faker::create();
        $this->modelNamespace = $modelNamespace;
    }

    /**
     * Setup database for each test
     */
    public function setUp()
    {
        parent::setUp();

        $this->app['artisan']->call('migrate');
    }


    /**
     * Get JSON output from API
     *
     * @param        $uri
     * @param string $method
     * @param array  $parameters
     * @return mixed
     */
    protected function getJson($uri, $method = 'GET', $parameters = [])
    {
        return json_decode($this->call($method, $uri, $parameters)->getContent());
    }

    /**
     * Assert object has any number of attributes
     *
     */
    protected function assertObjectHasAttributes()
    {
        $args = func_get_args();
        $object = array_shift($args);

        foreach ($args as $attribute)
        {
            $this->assertObjectHasAttribute($attribute, $object);
        }
    }

}