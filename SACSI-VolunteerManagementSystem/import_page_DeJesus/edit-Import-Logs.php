<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Database Management - Edit Import Logs</title>

  <!-- Bootstrap 5 CSS (keeps your existing utilities) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root{
      --header-height: 80px;
      --header-bg: #B2000C;
      --card-max: 900px;
    }

    /* Reset / base */
    *{ 
        box-sizing: border-box; 
        margin:0; 
        padding:0; 
    }

    html,body { 
        height:100%; 
    }

    body{
      min-height:100vh;
      padding-top: var(--header-height); /* reserve space for fixed header */
      overflow-y: auto; /* allow page scrolling */
      background: #f7f7f7;
      color: #222;
    }

    .database-header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 80px;
    z-index: 1000;
    background-color: #B2000C;
    color: white;
    padding: 1rem 2rem;
    box-sizing: border-box;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Flex wrapper for back button, title, menu */
    .header-content {
    display: flex;
    align-items: center;
    justify-content: space-between; /* pushes left + center + right */
    height: 100%;
    position: relative;
    }

    /* Back button */
    .back-button {
    background: none;
    border: none;
    padding: 0.5rem 1rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    transition: background 0.3s ease;
    }

    .back-button:hover {
    outline: #fff solid 1px;
    background: rgba(0, 0, 0, 0.05);
    }

    .back-button i {
    font-size: 32px;
    color: #d2cbcb;
    transition: color 0.3s ease;
    }

    .back-button:hover i {
    color: #fff;
    }

    /* Title in center */
    .header-content h1 {
    flex: 1;
    text-align: center;
    margin: 0;
    }

    /* Header actions (container for button + dropdown) */
    .header-actions {
    margin-left: auto; /* pushes it all the way right */
    display: flex;
    align-items: center;
    height: 100%;
    }

    /* Main / section layout */
    section{
      min-height: calc(100vh - var(--header-height));
      scroll-snap-align: start;
      display: flex;
      align-items: flex-start; /* card sits near top; adjust to center if you prefer */
      justify-content: center;
      padding: 1.5rem 0;
      overflow: visible; /* let inner content overflow if needed on small screens */
    }

    .database-container{ width:100%; display:flex; flex-direction:column; align-items:center; }

    .database-main{
      width:100%;
      max-width: 1100px;
      padding: 1rem;
    }

    /* Card / form */
    .edit-section {
        width: clamp(360px, 95%, 1100px); /* 🔹 wider card: min 360px, max 1100px */
        background: #fff;
        border-radius: 14px;
        padding: 2rem; /* 🔹 more padding makes the card "longer" */
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        margin: 0 auto;
        animation: slideUp .6s ease-out both;
    }

    .edit-section h2 {
        margin-bottom: 1.5rem; /* 🔹 a bit more space under heading */
        font-size: clamp(1.2rem, 2.8vw, 1.8rem);
        color: #c41e3a;
        font-weight: 600;
    }

        /* Responsive grid for inputs */
    .input-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); /* 🔹 inputs expand more */
        gap: 1.5rem; /* 🔹 slightly bigger spacing */
        width: 100%;
        margin-bottom: 2rem;
    }

    .input-grid .volunteer-info input {
        padding: 0.75rem 1rem;  /* 🔹 taller inputs */
        font-size: 1rem;        /* 🔹 slightly bigger text */
        border-radius: 8px;     /* optional: rounder look */
    }


    .input-grid .volunteer-info input:focus{
        outline: none;
        border-color: #702626;
        background: #f3f4f6;
        box-shadow: none;
    }

    .submit-section{
        display:flex;
        gap:1rem;
        justify-content:center;
        padding-top: .5rem;
    }

    .submit-section .btn { 
        padding:.5rem 1rem; 
    }

    /* simple slideUp keyframes */
    @keyframes slideUp {
        from { opacity:0; 
        transform: translateY(12px); 
        }
        to { 
            opacity:1; transform: translateY(0); 
        }
    }

    @media (min-width: 1200px){
      .edit-section { padding: 2rem; }
    }

    @media (max-width: 600px) {
    body {
        padding-top: 60px;
    }

    section {
        height: calc(100vh - 60px);
        min-height: calc(100vh - 60px);
        max-height: calc(100vh - 60px);
    }

    .scroll-container {
        height: calc(100vh - 60px);
    }

    .database-header {
        height: 60px;
        padding: 0.5rem;
    }

    .header-content h1 {
        font-size: 1.1rem;
    }
}
    /* Extra small devices */
    @media (max-width: 400px) {
        .database-header {
            height: 50px;
            padding: 0.3rem 0.5rem;
        }

        .header-content {
            gap: 0.5rem;
        }

        .header-content h1 {
            font-size: 1rem;
            text-align: left;
        }

        .back-button {
            margin-right: 0.5rem;
        }

        .header-actions {
            margin-left: 0.5rem;
        }
    }
  </style>
</head>
<body>
    <!--Hamburger Navbar-->
    <header class="database-header">
        <div class="header-content">    
            <button class="back-button" onclick="window.location.href='../import_page_DeJesus/import_page.html'">
                <i class='fas fa-long-arrow-alt-left' style='font-size:36px'></i>
            </button>

            <h1>Database Management</h1>
        
            <div class="header-actions">
                <div class="dropdown action-dropdown">
                <button class="btn btn-lg btn-outline-text-light dropdown-toggle action-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bars" aria-hidden="true"></i>
                    <span class="visually-hidden">Toggle menu</span>
                </button>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Home</a></li>
                    <li><a class="dropdown-item" href="#">Student Profile</a></li>
                    <li><a class="dropdown-item" href="#">Student Profile Manager</a></li>
                    <li><a class="dropdown-item" href="#">Import Volunteer</a></li>
                    <li><a class="dropdown-item" href="#">Create Event</a></li>
                    <li><a class="dropdown-item" href="#">Event Manager</a></li>
                    <li><a class="dropdown-item" href="#">Summary Report</a></li>
                </ul>
                </div>
            </div>
        </div>
    </header>

    <section id="edit-Section">
        <div class="database-container">
          <main class="database-main">
            <div class="edit-section" role="region" aria-label="Edit Volunteer">
              <h2>Edit Student Volunteer Data</h2>

              <div class="input-grid">
                <div class="volunteer-info"><input type="text" class="form-control" id="Volunteer-FileName" placeholder="File Name"></div>
                <div class="volunteer-info"><input type="text" class="form-control" id="Volunteer-UploadedBy" placeholder="Uploaded By"></div>
                <div class="volunteer-info"><input type="text" class="form-control" id="Volunteer-UploadedAt" placeholder="Uploaded At"></div>
            </div>

            <div class="submit-section">
                <button class="btn btn-danger submit-database">Apply Changes</button>
                <button class="btn btn-outline-secondary">Cancel</button>
              </div>
            </div>
          </main>
        </div>
    </section>

  <!-- Bootstrap JS (optional for dropdown) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
