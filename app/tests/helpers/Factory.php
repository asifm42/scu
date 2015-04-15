<?php

trait Factory {

    /**
     * @var int
     */
    protected $times = 1;

    /**
     * Number of times to make entities
     *
     * @param $count
     * @return $this
     */
    protected function times($count)
    {
        $this->times = $count;

        return $this;
    }

    /**
     * Make a new record in the DB
     *
     * @param       $type
     * @param array $fields
     * @throws BadMethodCallException
     */
    protected function make($type, array $fields = [])
    {
        $type = $this->modelNamespace . $type;

        while ($this->times--)
        {
            $stub = array_merge($this->getStub(), $fields);

            $type::create($stub);
        }

        $this->times = 1;
    }

    /**
     * @throws BadMethodCallException
     */
    protected function getStub()
    {
        throw new BadMethodCallException('Create your own getStub method to declare your fields.');
    }

}