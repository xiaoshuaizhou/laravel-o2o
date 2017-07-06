<?php


namespace App\Service\Admin;


use App\Events\UserChangeStatus;
use App\Repositories\Bis\BisRepository;

/**
 * Class EmailService
 * @package App\Service\Admin
 */
class EmailService {
    /**
     * @var BisRepository
     */
    public $bisRepository;

    /**
     * EmailService constructor.
     * @param BisRepository $bisRepository
     */
    public function __construct(BisRepository $bisRepository) {
        $this->bisRepository = $bisRepository;
    }

    /**
     * @param $id
     */
    public function send($id) {
        $this->bisRepository->whereForm($id);
        event(new UserChangeStatus($this->bisRepository->latestFirst()));
    }

    /**
     * @param $id
     * @param $status
     */
    public function senddeleteEmail($id, $status) {
        $this->bisRepository->changStatusDel($id, $status);
        event(new UserChangeStatus($this->bisRepository->latestFirst()));
    }
}