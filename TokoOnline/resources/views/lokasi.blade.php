<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Location</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<section id="location" class="py-5" style="background-color: #f9f9f9;">
  <div class="container">
    
    <!-- Back Button -->
    <div class="mb-4">
      <button onclick="history.back()" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back
      </button>
    </div>

    <!-- Title and Address -->
    <div class="row justify-content-center text-center mb-4">
      <div class="col-lg-8">
        <h2 class="fw-bold text-success">📍 Our Location</h2>
        <p class="lead">We are ready to serve you at the following address:</p>
        <p class="fs-5 text-muted">
          <i class="bi bi-geo-alt-fill text-danger"></i>
          Jl. Merdeka, Abadijaya, Sukmajaya District, Depok City, West Java 16417
        </p>
      </div>
    </div>

    <!-- Google Maps Embed -->
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="ratio ratio-16x9 shadow rounded-4 border">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d247.81135137444122!2d106.84649068193946!3d-6.396369592828118!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sid!4v1747019442797!5m2!1sen!2sid" 
            style="border:0;" 
            allowfullscreen 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
