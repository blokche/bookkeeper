<?php

namespace Model;

use W\Model\UsersModel;

class UserModel extends UsersModel {

    public function __construct()
    {
        parent::__construct();
        $this->setTable("users");
    }
}
