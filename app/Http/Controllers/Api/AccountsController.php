<?php

namespace App\Http\Controllers\Api;

use App\Account;
use App\Contracts\Repositories\AccountsRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    /**
     * @param AccountsRepository $repository
     * @param Request            $request
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(AccountsRepository $repository, Request $request)
    {
        if ($search = $request->query('search')) {
            return $repository->paginate(1, 10);
        }

        return $repository->paginate(1, 10);
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
