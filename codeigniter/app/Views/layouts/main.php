<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $this->renderSection('title'); ?></title>
  <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/assets/css/custom.css">
</head>

<body>
  <div class="container-fluid p-0 d-flex flex-column vh-100">
    
    <?= $this->include('components/navbar') ?>
    <?= $this->renderSection('content'); ?>

    <div class="modal fade" id="modal" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"></h5>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
  </div>

  

  <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/js/util/setCSRF.js"></script>
  <script src="/assets/js/util/popModal.js"></script>

  <script>
    var csrfToken = '<?= csrf_token() ?>';
    var csrfHash = '<?= csrf_hash() ?>';  
  </script>
  <?= $this->renderSection('scripts'); ?>

</body>

</html>