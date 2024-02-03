<nav class="navbar navbar-fixed-top shadow navbar-default  py-2" style="background-color:white;">
      <div class="d-flex flex-column container-fluid align-items-center">
        <?php 
          $loggedIn = session()->get('loggedIn');
          $userType = session()->get('userType');
          if (!$loggedIn)
            echo view('components/navbarDefault');
          if ($userType == 'Customer')
            echo view('components/navbarCustomer');
          else if ($userType == 'Seller')
            echo view('components/navbarSeller');
        ?>
      </div>
</nav>