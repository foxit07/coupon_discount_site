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

    private $clientId = 'c43bc2a73cf44fb4b29b13be03a9a3';
    private $clientPassword = 'fe87c1897aa8ad8b43c81e9ee043be';
    private $username = 'foxit77';
    private $password = '4CApv5omBf';
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
    


//print_r($connect);die;
}


}
