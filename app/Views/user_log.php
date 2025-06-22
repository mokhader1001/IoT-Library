<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Miftaah Library Card Access</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to bottom right, #e0f7fa, #ffffff);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-box {
      background: #fff;
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 480px;
      position: relative;
    }

    .library-logo {
      width: 110px;
      height: 110px;
      object-fit: contain;
      margin: 0 auto 10px auto;
      display: block;
    }

    .header-text {
      text-align: center;
      margin-bottom: 1.8rem;
    }

    .admin-link {
      position: absolute;
      top: 15px;
      right: 20px;
      font-size: 0.92rem;
    }

    .admin-link a {
      color: #007bff;
      text-decoration: none;
    }

    .admin-link a:hover {
      text-decoration: underline;
    }

    .info-box {
      font-size: 0.87rem;
      color: #555;
      margin-top: 2rem;
    }
  </style>
</head>
<body>

<div class="login-box text-center">
  <div class="admin-link">
    <i class="fas fa-lock"></i> <a href="<?= base_url('Admin') ?>">Admin Panel</a>
  </div>

  <img src="<?= base_url('public/uploads/logo.png') ?>" alt="Miftaah Library Logo" class="library-logo">

  <div class="header-text">
    <h4><i class="fas fa-id-card text-primary me-1"></i> Library Card Access</h4>
    <p class="text-muted">Place your library card on the scanner to continue.</p>
  </div>

  <form id="cardLoginForm">
    <input 
      type="text" 
      class="form-control mb-3" 
      id="cardInput" 
      name="cardInput"
      readonly 
      value="Waiting for scan..."
    />
  </form>

  <div class="info-box">
    <p><strong>Dhobaale Library</strong> provides equitable access to resources for students. Use your card for borrowing, digital archives, and study rooms. Respect library rules and enjoy your academic journey.</p>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
const base_url = "<?= base_url() ?>";
let lastUID = '';       // Track last scanned UID
let isProcessing = false; // Prevent multiple triggers

// Function to fetch UID from backend
function fetchCardUID() {
  if (isProcessing) return; // Skip if still processing

  $.getJSON(base_url + 'get_uid', function(data) {
    if (data && data.uid && data.uid !== lastUID) {
      lastUID = data.uid;
      $('#cardInput').val(data.uid).trigger('input');
    }
  });
}

// Trigger when new UID is written to input
$('#cardInput').on('input', function () {
  const card_number = $(this).val().trim();

  if (card_number.length > 0 && !isProcessing) {
    isProcessing = true; // Start processing

    $.ajax({
      url: base_url + 'checkCardId',
      type: 'POST',
      data: { card_number },
      dataType: 'json',
      success: function (res) {
        if (res.success) {
          // If card is valid
          $.post(base_url + 'sendVerificationCode', { email: res.email }, function(sendRes) {
            if (sendRes.success) {
              Swal.fire({
                icon: 'success',
                title: 'Code Sent',
                text: 'Verification code is sent',
                timer: 2000,
                showConfirmButton: false
              }).then(() => {
                window.location.href = base_url + 'user/verfications';
              });
            } else {
              Swal.fire('Error', sendRes.message || 'Failed to send verification code.', 'error');
              resetScanner();
            }
          }, 'json');
        } else {
          // Card is invalid
          setTimeout(() => {
            Swal.fire({
              icon: 'error',
              title: 'Invalid Card',
              text: res.message || 'This card is not registered.',
              showConfirmButton: false,
              timer: 2000
            });
            resetScanner();
          }, 3000); // wait 3 seconds before showing the message
        }
      },
      error: function () {
        Swal.fire('Error', 'Server error. Please try again.', 'error');
        resetScanner();
      }
    });
  }
});

// Reset scanner input
function resetScanner() {
  lastUID = '';
  isProcessing = false;
  $('#cardInput').val('Waiting for scan...');
}

// Start polling every 3 seconds
setInterval(fetchCardUID, 3000);
</script>

</body>
</html>
