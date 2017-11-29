<?php
/**
 * Created by PhpStorm.
 * User: foxit
 * Date: 07.11.2017
 * Time: 14:34
 */

namespace frontend\modules\admitad\models;
use Admitad\Api\Api;
use yii\helpers\ArrayHelper;

class Connection extends Api
{
    private $clientId = '';
    private $clientPassword = '';
    private $username = '';
    private $password = '';
    private $token = null;
    public $scope ='coupons '.'coupons_for_website ';

    public function __construct($scope=NULL)
    {
       if($scope==NULL){
           $scope=$this->scope;
       }
        $this->scope=$scope;
        $this->connect();
    }

    public function connect()
    {
        $connect = $this->authorizeByPassword(
            $clientId = $this->clientId,
            $clientPassword = $this->clientPassword,
            $scope = $this->scope,
            $username = $this->username,
            $password = $this->password
        )->getArrayResult();
        $this->token = ArrayHelper::toArray($connect)['access_token'];
        $this->setAccessToken($this->token);
    }

}