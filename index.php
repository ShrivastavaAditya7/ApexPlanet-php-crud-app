<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require 'auth_session.php';
require 'db.php';

// Fetch blog posts
$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard - ApexPlanet</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: #f8fafc;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .navbar {
      background-color: #0f172a;
    }

    .navbar-brand, .nav-link {
      color: #f8fafc !important;
    }

    .container {
      margin-top: 60px;
    }

    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .btn-edit {
      background-color: #38bdf8;
      color: #fff;
    }

    .btn-delete {
      background-color: #f87171;
      color: #fff;
    }

    .header-title {
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 30px;
      text-align: center;
    }

    .card-title {
      font-size: 20px;
      font-weight: bold;
    }

    .add-btn {
      background-color: #16a34a;
      color: white;
    }

    .add-btn:hover {
      background-color: #15803d;
    }

    .logout-btn {
      color: #f8fafc;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ApexPlanet</a>
    <div class="d-flex">
      <span class="navbar-text text-light me-3">
        Welcome, <?= htmlspecialchars($_SESSION['username']) ?>
      </span>
      <a href="logout.php" class="btn btn-sm btn-outline-light logout-btn">Logout</a>
    </div>
  </div>
</nav>

<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="header-title">📚 Blog Posts</h2>
    <a href="create.php" class="btn add-btn">+ Add New Post</a>
  </div>

  <div class="row g-4">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
            <p class="card-text"><?= nl2br(htmlspecialchars($row['content'])) ?></p>
          </div>
          <div class="card-footer bg-white border-0 d-flex justify-content-between">
            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-edit">Edit</a>
            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-delete" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

</body>
</html>
