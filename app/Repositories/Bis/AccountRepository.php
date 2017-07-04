<?php

namespace App\Repositories\Bis;
use App\Models\Bis\Account;

/**
 * Class AccountRepository
 * @package App\Repositories\Bis
 */
class AccountRepository
{
    /**
     * @var Account
     */
    public $account;

    /**
     * AccountRepository constructor.
     * @param Account $account
     */
    public function __construct(Account $account) {
        $this->account = $account;
    }
    /**
     * 根据bis_id 查询数据
     * @param $bisId
     * @return mixed
     */
    public function getBisByBisId($bisId)
    {
        $data = [
                'bis_id' => $bisId,
                'is_man' => 1
        ];
        $res = $this->account->where($data)->first();
        return $res;
    }
    /**
     * @param $username
     * @return mixed
     */
    public function whereFromUsername($username) {
        return $this->account->where('username', '=', $username)->first();
    }
    /**
     * @param $data
     * @return mixed
     */
    public function create($data) {
        return $this->account->create($data);
    }
    /**
     * @param $bisId
     * @return mixed
     */
    public function whereFormBisId($bisId) {
        return $this->account->where('bis_id', $bisId)->first();
    }

}
