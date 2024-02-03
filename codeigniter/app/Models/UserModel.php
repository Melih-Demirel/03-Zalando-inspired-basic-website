<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $primaryKey = 'user_id';
    protected $table = 'user';
    protected $allowedFields = ['email', 'password', 'verification_token', 'verified'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data){
        $data = $this->hashPassword($data);
        return $data;
    }
    
    protected function beforeUpdate(array $data){
        $data = $this->hashPassword($data);
        return $data;
    }
    
    protected function initialize()
    {
        helper(['auth', 'response', 'mail', 'token']);
    }

    protected function hashPassword(array $data){
        if(isset($data['data']['password']))
          $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }

    public function getRoleOfUser($user) {
        $roleOfuser = db_connect()->table('userrole')->getWhere(['user' => $user])->getFirstRow()->role;
        $roleName = db_connect()->table('role')->getWhere(['role_id' => $roleOfuser])->getFirstRow()->name;
        return $roleName;
    }

    public function createUser($user, $userRole) {
        if (!$this->insert($user))
            return createResponse(false, 'User not existing!');

        $insertId = $this->getInsertID();
        $roleId = db_connect()->table('Role')->getWhere(['name' => $userRole])->getFirstRow()->role_id;
        if ($roleId == null) {
            $this->delete($insertId);
            return createResponse(false, "Not valid role!");
        }
        if (!db_connect()->table('UserRole')->insert(['user' => $insertId , 'role' => $roleId])) {
            $this->delete($insertId);
            return createResponse(false, "Failed to assign an user for the user!");
        }
        $token = createToken();
        $this->update($insertId, ['verification_token' => $token]);
        sendVerificationMail($this->getWhere(['user_id' => $insertId])->getFirstRow('array'), $token);
        return createResponse(true,'Successfully created your account! Verify your account!');
    }

    public function verifyUser($verificationToken) {
        $verified = $this->getWhere(['verification_token' => $verificationToken])->getFirstRow();
        if($verified){
            $this->update($verified->user_id, ['verification_token' => '']);
            $this->update($verified->user_id, ['verified' => true]);
            return true;
        }
        else{
            return false;
        }
    }
}