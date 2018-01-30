<?php

namespace App\Http\Controllers\Api;

use App\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Account::query()->get();
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(Request $request)
    {
        return Account::create($request->all());
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function browse($id)
    {
        return Account::findOrFail($id);
    }

    /**
     * @param int     $id
     * @param Request $request
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($id, Request $request)
    {
        $model = Account::findOrFail($id);

        $model->fill($request->all());
        $model->saveOrFail();

        return $model;
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function delete($id)
    {
        $model = Account::findOrFail($id);

        $model->delete();

        return $model;
    }
}
