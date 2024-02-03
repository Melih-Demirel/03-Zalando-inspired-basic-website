<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class UserRecoveryModel extends Model
{
    protected $table = 'userrecovery';
    protected $allowedFields = ['user', 'exp_date', 'recovery_token'];
    
    protected function initialize()
    {
        helper(['response', 'auth']);
    }

    public function isRecoveryTokenValid($token) {
        return ($this->getWhere(['recovery_token' => $token])->getNumRows() > 0);
    }

    public function createRecoveryForUser($userId) {
        helper(['token', 'mail']);
        $token = createToken();
        $this->insert(['user' => $userId, 'exp_date' => (new Time("+1 day"))->toDateTimeString(), 'recovery_token' => $token]);
        sendRecoverPasswordMail((new UserModel())->getWhere(['user_id' => $userId])->getFirstRow('array'), $token);
    }
}