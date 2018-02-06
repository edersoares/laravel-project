<?php

namespace Tests;

abstract class ApiTestCase extends TestCase
{
    /**
     * Return table name.
     *
     * @return string
     */
    abstract protected function getTable();

    /**
     * Return API endpoint.
     *
     * @return string
     */
    abstract protected function getEndpoint();

    /**
     * Return model name.
     *
     * @return string
     */
    abstract protected function getModel();

    /**
     * @param int $id
     *
     * @return string
     */
    protected function getUrl($id = null)
    {
        if (is_null($id)) {
            return $this->getEndpoint();
        }

        return $this->getEndpoint() . '/' . $id;
    }

    /**
     * GET :endpoint
     *
     * @return void
     */
    public function testIndex()
    {
        factory($this->getModel(), $num = rand(3, 10))->create();

        $url = $this->getUrl();

        $this->get($url)
            ->assertStatus(200)
            ->assertJsonCount($num, 'data');
    }

    /**
     * POST :endpoint
     *
     * @return void
     */
    public function testCreate()
    {
        $model = factory($this->getModel())->make();

        $key = $model->getKey();
        $arr = $model->toArray();
        $url = $this->getUrl($key);

        $this->post($url, $arr)
            ->assertStatus(201)
            ->assertJsonFragment($arr);

        $this->assertDatabaseHas($this->getTable(), $arr);
    }

    /**
     * GET :endpoint
     *
     * @return void
     */
    public function testBrowse()
    {
        $model = factory($this->getModel())->create();

        $key = $model->getKey();
        $arr = $model->toArray();
        $url = $this->getUrl($key);

        $this->get($url, $arr)
            ->assertStatus(200)
            ->assertJsonFragment($arr);

        $this->assertDatabaseHas($this->getTable(), $arr);
    }

    /**
     * PUT :endpoint
     *
     * @return void
     */
    public function testUpdate()
    {
        $model = factory($this->getModel())->create();

        $key = $model->getKey();

        $model = factory($this->getModel())->make();

        $arr = $model->toArray();
        $url = $this->getUrl($key);

        $this->put($url, $arr)
            ->assertStatus(200)
            ->assertJsonFragment($arr);

        $this->assertDatabaseHas($this->getTable(), $arr);
    }

    /**
     * PUT :endpoint
     *
     * @return void
     */
    public function testDelete()
    {
        $model = factory($this->getModel())->create();

        $key = $model->getKey();
        $arr = $model->toArray();
        $url = $this->getUrl($key);

        $this->delete($url, $arr)
            ->assertStatus(200)
            ->assertJsonFragment($arr);

        $this->assertDatabaseMissing($this->getTable(), $arr);
    }
}
