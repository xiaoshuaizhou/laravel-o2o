<?php


namespace App\Service\Admin;


use App\Events\UserChangeStatus;
use App\Repositories\Bis\BisRepository;

class EmailService {
    public $bisRepository;
    public function __construct(BisRepository $bisRepository) {
        $this->bisRepository = $bisRepository;
    }

    public function send($id) {
        $this->bisRepository->whereForm($id);
        event(new UserChangeStatus($this->bisRepository->latestFirst()));
    }

    public function senddeleteEmail($id, $status) {
        $this->bisRepository->changStatusDel($id, $status);
        event(new UserChangeStatus($this->bisRepository->latestFirst()));
    }
}