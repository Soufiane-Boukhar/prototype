<?php

namespace App\Repository;

use App\Models\Member;

use App\Repository\BaseRepository;

class MemberRepository extends BaseRepository{

    public function __construct(Member $model){
        $this->model = $model;
    }

    protected $fieldsMember = [
        'name','email','role','password'
    ];

    public function getFieldData():array{
        return $this->fieldsMember;
    }

    public function model():string{
        return Member::class;
    }
}