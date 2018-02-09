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
            $repository->search($search);
        }

        return $repository->paginate(1, 10)->all();
    }

    /**
     * @param AccountsRepository $repository
     * @param Request            $request
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(AccountsRepository $repository, Request $request)
    {
        return $repository->create($request->all());
    }

    /**
     * @param AccountsRepository $repository
     * @param int                $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function browse(AccountsRepository $repository, $id)
    {
        return $repository->browse($id);
    }

    /**
     * @param int                $id
     * @param AccountsRepository $repository
     * @param Request            $request
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($id, AccountsRepository $repository, Request $request)
    {
        return $repository->update($id, $request->all());
    }

    /**
     * @param int                $id
     * @param AccountsRepository $repository
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function delete($id, AccountsRepository $repository)
    {
        return $repository->delete($id);
    }
}
