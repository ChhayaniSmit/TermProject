<?php
session_start();
include '../includes/db_connect.php';
include '../includes/navbar.php';

// Fetch all books
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
$books = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Available Books | Libro</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/FinalProject/assets/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="text-center mb-4">📚 Browse Books</h2>
    <div class="row g-4">
        <?php foreach ($books as $book): ?>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <img src="<?= $book['image_url'] ?>" class="card-img-top" style="height: 320px; object-fit: cover;" alt="<?= $book['title'] ?>">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?= $book['title'] ?></h5>
                    <p class="mb-1"><strong>Author:</strong> <?= $book['author'] ?></p>
                    <p class="mb-1"><strong>Category:</strong> <?= $book['category'] ?></p>
                    <p class="mb-2"><strong>Status:</strong>
                        <?= $book['status'] === 'available' 
                            ? '<span class="badge bg-success">Available</span>' 
                            : '<span class="badge bg-danger">Not Available</span>' ?>
                    </p>
                    <button class="btn btn-outline-primary btn-sm mt-auto" data-bs-toggle="modal" data-bs-target="#bookModal<?= $book['book_id'] ?>">
                        View Details
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Modals for Each Book -->
<?php foreach ($books as $book): ?>
<div class="modal fade" id="bookModal<?= $book['book_id'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $book['book_id'] ?>" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel<?= $book['book_id'] ?>"><?= $book['title'] ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex flex-column flex-md-row">
        <img src="<?= $book['image_url'] ?>" class="img-fluid me-4 mb-3 mb-md-0" style="max-height: 250px;" alt="Cover">

        <div>
          <p><strong>Author:</strong> <?= $book['author'] ?></p>
          <p><strong>Category:</strong> <?= $book['category'] ?></p>
          <p><strong>ISBN:</strong> <?= $book['isbn'] ?></p>
          <p><strong>Description:</strong><br>
              <?= $book['description'] ?: '<span class="text-muted">No description provided.</span>' ?>
          </p>
          <p><strong>Status:</strong>
              <?= $book['status'] === 'available'
                  ? '<span class="badge bg-success">Available</span>'
                  : '<span class="badge bg-danger">Not Available</span>' ?>
          </p>

          <?php if ($book['status'] === 'available'): ?>
          <form method="POST" action="borrow_book.php" class="mt-3">
              <input type="hidden" name="book_id" value="<?= $book['book_id'] ?>">
              <button type="submit" class="btn btn-success">📚 Borrow This Book</button>
          </form>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>

</body>
</html>
