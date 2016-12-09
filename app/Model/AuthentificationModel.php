<?php
namespace Model;

class AuthentificationModel extends \W\Model\Model
{
    public function findToken($token)
    {
        $sql="SELECT* FROM users WHERE token= :token";
        $q=$this->dbh->prepare($sql);
        $q->bindValue(':token',$token);
        $q->execute();
        return $q->fetch();
    }
}