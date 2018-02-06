<?php

namespace Tests\Feature\Api;

use App\Account;
use Illuminate\Foundation\Testing\WithoutEvents;
use Tests\ApiTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountsTest extends ApiTestCase
{
    use RefreshDatabase, WithoutEvents;

    /**
     * @inheritdoc
     */
    protected function getTable()
    {
        return 'accounts';
    }

    /**
     * @inheritdoc
     */
    protected function getEndpoint()
    {
        return 'api/accounts';
    }
    
    /**
     * @inheritdoc
     */
    protected function getModel()
    {
        return Account::class;
    }
}
