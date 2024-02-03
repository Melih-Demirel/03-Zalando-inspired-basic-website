<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\SellerModel;
use App\Models\UserModel;
use App\Models\UserRecoveryModel;


class Auth extends BaseController
{
    public function index() {
        helper(['form', 'auth']);

        if ($this->request->getMethod() == 'get') {
            $loggedIn = session()->get('loggedIn');
            $userType = session()->get('userType');
            if ($loggedIn && $userType == 'Customer')
                return redirect()->to(base_url() . '/customer/account');
            else if ($loggedIn && $userType == 'Seller')
                return redirect()->to(base_url() . '/seller/account');
            return view('/auth/signin');
        }
        $signInRules = [
            'email' => 'required|min_length[6]|max_length[255]|valid_email',
            'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
        ];
        $errors = ['password' => ['validateUser' => "Email or password don't match."]];

        if (!$this->validate($signInRules, $errors))
            return view('auth/signin', ['validation' => $this->validator]);    
    
        $userM = new UserModel(); 
        $user = $userM->where('email', esc($this->request->getVar('email')))->first();
        $userRole = $userM->getRoleOfUser($user['user_id']); 
        if ($userRole == 'Customer') {
            createSession($user, 'Customer');
            return redirect()->to(base_url() . '/products');
        } else if ($userRole == 'Seller') {
            createSession($user, 'Seller');
            return redirect()->to(base_url() . '/seller/account');    
        }
    }

    public function signout() {
        session()->destroy();
        return redirect()->to(base_url());
    }

    public function register() {
        if ($this->request->getMethod() == 'get') {
            $loggedIn = session()->get('loggedIn');
            $userType = session()->get('userType');
            if ($loggedIn && $userType == 'Customer')
                return redirect()->to(base_url() . '/products');
            else if ($loggedIn && $userType == 'Seller')
                return redirect()->to(base_url() . '/seller/account');
            return view('/auth/register');
        }
    }

    public function registerCustomer() {
        helper(['form', 'mail']);
        
        if ($this->request->getMethod() == 'get'){
            $loggedIn = session()->get('loggedIn');
            $userType = session()->get('userType');
            if ($loggedIn && $userType == 'Customer')
                return redirect()->to(base_url() . '/products');
            else if ($loggedIn && $userType == 'Seller')
                return redirect()->to(base_url() . '/seller/account');
            return view('auth/registerCustomer');
        }

        $registerCustomerRules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'surname' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|min_length[6]|max_length[255]|valid_email|is_unique[user.email]',
            'password' => 'required|min_length[8]|max_length[255]',
            'password_confirm' => 'matches[password]',
        ];

        if ($this->validate($registerCustomerRules)) {

            $userData = ['email' => esc($this->request->getVar('email')), 'password' => esc($this->request->getVar('password'))];
            $userId = $this->createUser($userData, 'Customer');
            $customerM = new CustomerModel();
            $customerData = [
                'user' => $userId,
                'name' => esc($this->request->getVar('name')),
                'surname' => esc($this->request->getVar('surname')),
            ];
            $customerM->save($customerData);

            return view('auth/verifyUser', ['email' => $userData['email']]);
        }
        return view('auth/registerCustomer', ['validation' => $this->validator]);
    }

    public function registerSeller() {

        helper(['form', 'mail']);

        if ($this->request->getMethod() == 'get'){
            $loggedIn = session()->get('loggedIn');
            $userType = session()->get('userType');
            if ($loggedIn && $userType == 'Customer')
                return redirect()->to(base_url() . '/products');
            else if ($loggedIn && $userType == 'Seller')
                return redirect()->to(base_url() . '/seller/account');
            return view('auth/registerSeller');
        }
            

        $registerSellerRules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|min_length[6]|max_length[255]|valid_email|is_unique[user.email]',
            'description' => 'required',
            'password' => 'required|min_length[8]|max_length[255]',
            'password_confirm' => 'matches[password]',
        ];

        if ($this->validate($registerSellerRules)) {
            $userData = ['email' => esc($this->request->getVar('email')), 'password' => esc($this->request->getVar('password'))];
            $userId = $this->createUser($userData, 'Seller');

            $sellerM = new SellerModel();
            $sellerData = [
                'user' => $userId,
                'name' => esc($this->request->getVar('name')),
                'description' => esc($this->request->getVar('description'))
            ];
            $sellerID = $sellerM->insert($sellerData);
            $sellerM->saveImagesOfSeller($sellerID, esc($this->request->getFileMultiple('images')));
            return view('auth/verifyUser', ['email' => $userData['email']]);   
        }
        return view('auth/registerSeller', ['validation' => $this->validator]);
    }
    
    public function verifyUser($verifyToken) {
    
        if ((new UserModel())->verifyUser($verifyToken))
            return view('auth/verificationSuccess.php');
        else
            return view('auth/verificationFail.php');    
    }
    
    public function forgotPassword() {
        helper(['form', 'mail']);
        if ($this->request->getMethod() == 'get')
            return view('auth/forgotPassword');
        $forgotRules = [ 'email' => 'required|valid_email'];
        if ($this->validate($forgotRules)) {
            $email = esc($this->request->getVar('email'));
            $user = (new UserModel())->getWhere(['email' => $email])->getFirstRow('array');
            if ((new UserRecoveryModel())->createRecoveryForUser($user['user_id'])) {
                return view('auth/passwordReset.php', ['email' => $email]);
            }
        }
        return view('auth/passwordResetFail');
    }

    public function resetPassword($userId) {
        helper(['form']);

        $resetRules = ['password' => 'required|min_length[8]|max_length[255]'];
        if ($this->validate($resetRules)) {
            (new UserModel())->update($userId, ['password' => esc($this->request->getVar('password'))]);
            return view('/auth/passwordResetSuccess');
        }
        return view('/auth/passwordResetFail');


    }

    public function recoverUser($recoveryToken) {       
        $userRecoveryModel = new UserRecoveryModel();
        if ($userRecoveryModel->isRecoveryTokenValid($recoveryToken)) {
            $userId = $userRecoveryModel->getWhere(['recovery_token' => $recoveryToken])->getFirstRow()->user;
            return view('auth/resetPassword', ['user_id' => $userId]);
        }
    }
    
    public function sendVerificationMail($email) {
        helper(['mail', 'token']);
        $userM = new UserModel();
        $user = $userM->getWhere(['email' => $email])->getFirstRow('array');
        $token = createToken();
        $userM->update($user['user_id'], ['verification_token' => $token]);
        sendVerificationMail($user, $token);
        return view('auth/verifyUser', ['email' => $email, 'token' => $token]);
    }

    private function createUser($userData, $userType) {
        $userM = new UserModel();
        $userM->createUser($userData, $userType);
        return $userM->getInsertID();
    }
}