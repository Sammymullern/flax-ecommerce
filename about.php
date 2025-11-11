<?php
require 'vendor/autoload.php';

$Parsedown = new Parsedown();
$markdown = file_get_contents('content/about.md');
$html = $Parsedown->text($markdown);
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
 
     <!-- Site Metas -->
    <title>About - SpringTech</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

 <link rel="stylesheet" href="style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/5.2.0/github-markdown.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/github.min.css">
<link href="https://fonts.googleapis.com/css2?family=Fira+Code&family=Inter&display=swap" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>
<script>hljs.highlightAll();</script>


  <title>About</title>
    <link rel="icon" type="image/png" href="images/favcon.png">



  <style>
/* Markdown Container */

/* Header Container */
.header {
    background-color: #fff;
    padding: 15px 0;
    border-bottom: 1px solid #e0e0e0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

/* Navbar layout using Flex */
.navbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    padding: 0 15px;
    border: none;
    background-color: transparent;
}

/* Brand (logo) on left */
.navbar-brand {
    margin-right: auto;
}
.navbar-brand img {
    height: 50px;
}

/* Center the menu */
.menu-top {
    display: flex;
    justify-content: center;
    flex: 1;
    margin: 0;
    padding: 0;
}
.menu-top li {
    list-style: none;
}
.menu-top li a {
    display: inline-block;
    padding: 10px 18px;
    background-color: #f5f5f5; /* Light button look */
    color: #333;
    font-weight: 600;
    font-size: 14px;
    border-radius: 25px;
    margin: 0 5px;
    border: 1px solid #ddd;
    transition: all 0.3s ease;
    text-decoration: none;
}

.menu-top li a:hover,
.menu-top li a.active {
    background-color: #4CAF50;
    color: #fff !important;
    border-color: #4CAF50;
}


/* SEO Button on the far right */
.top-btn {
    background-color: #4CAF50;
    color: #fff !important;
    border-radius: 25px;
    padding: 10px 20px;
    font-weight: bold;
    border: none;
    transition: 0.3s;
}
.top-btn:hover {
    background-color: #388E3C;
    color: #fff;
}

/* Responsive Toggle */
.navbar-toggle {
    display: none; /* hidden for now, you can enable for mobile */
}



.markdown-body {
  max-width: 800px;
  margin: 60px auto;
  background:rgb(141, 150, 58);
  color: #2c3e50;
  padding: 40px 50px;
  font-family: "Segoe UI", Roboto, "Helvetica Neue", sans-serif;
  border-radius: 16px;
  box-shadow: 0 10px 40px rgba(0,0,0,0.1);
  line-height: 1.7;
}

/* Headings */
.markdown-body h1,
.markdown-body h2,
.markdown-body h3 {
  color: #1e3a8a;
  font-weight: 700;
  margin-top: 40px;
  margin-bottom: 20px;
  border-bottom: 1px solidrgb(43, 100, 38);
  padding-bottom: 5px;
}

.markdown-body h1 {
  font-size: 2.4rem;
}
.markdown-body h2 {
  font-size: 1.8rem;
}
.markdown-body h3 {
  font-size: 1.4rem;
}

/* Paragraphs and Lists */
.markdown-body p {
  margin: 20px 0;
  font-size: 1.05rem;
}

.markdown-body ul {
  margin: 20px 0 20px 1.2rem;
  padding-left: 20px;
}
.markdown-body li {
  margin-bottom: 10px;
}

/* Blockquote */
.markdown-body blockquote {
  background: #f0f4ff;
  border-left: 4px solid #3b82f6;
  padding: 15px 20px;
  font-style: italic;
  margin: 20px 0;
  color: #1e40af;
}

/* Tables */
.markdown-body table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}
.markdown-body th,
.markdown-body td {
  border: 1px solid #ddd;
  padding: 10px;
}
.markdown-body th {
  background: #e0ecff;
  font-weight: 600;
}

/* Links */
.markdown-body a {
  color: #2563eb;
  text-decoration: none;
  border-bottom: 1px solid transparent;
  transition: all 0.3s;
}
.markdown-body a:hover {
  border-color: #2563eb;
}

/* Code blocks */
.markdown-body pre {
  background: #1e293b;
  color: #f8fafc;
  padding: 15px 20px;
  border-radius: 10px;
  overflow-x: auto;
  font-size: 0.95rem;
}
.markdown-body code {
  background: #f1f5f9;
  color: #1e293b;
  padding: 3px 6px;
  border-radius: 4px;
  font-family: 'Fira Code', monospace;
}

/* Code in Pre */
.markdown-body pre code {
  background: none;
  color: inherit;
  padding: 0;
}

/* Animations */
.markdown-body {
  animation: fadeInUp 0.8s ease-in-out;
}
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(25px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.site-footer {
  background: #1e293b;
  color: #cbd5e1;
  padding: 30px 0;
  text-align: center;
  margin-top: 60px;
  border-top: 4px solid #3b82f6;
}

.footer-container {
  max-width: 900px;
  margin: 0 auto;
  font-family: 'Segoe UI', sans-serif;
}

.footer-links {
  margin-top: 15px;
  font-size: 0.95rem;
}

.footer-links a {
  color: #93c5fd;
  text-decoration: none;
  margin: 0 10px;
  transition: color 0.3s;
}

.footer-links a:hover {
  color: #ffffff;
}

    .back-btn {
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 1000;
    background-color: #007bff;
    color: white;
    padding: 8px 16px;
    border-radius: 5px;
    text-decoration: none;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    transition: background-color 0.2s ease;
}

.back-btn:hover {
    background-color: #0056b3;
}



</style>

</head>
<body>
  <div class="markdown-body">
    <?php echo $html; ?>
  </div>

  <div id="content">
    <a href="javascript:history.back()" class="back-btn">← Back</a>
    <div id="markdown"></div>
</div>

     <!-- Scroll to Top -->
    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

    <!-- JS FILES -->
    <script src="js/all.js"></script>
    <script src="js/custom.js"></script>

<footer class="site-footer">


  <div class="footer-container">
    <div class="footer-logo">
      <img src="images/logos/logo-light.png" alt="FlaxSoft Logo">
    </div>
    <div class="footer-info">
      <p>&copy; <?php echo date("Y"); ?> SpringTech Solutions. All rights reserved.</p>
      <div class="footer-links">
        <a href="index.php">Home</a> |
        <a href="services/services.php">Services</a> |
        <a href="contact.php">Contact</a> |
        <a href="privacy/privacy.php">Privacy Policy</a>
      </div>
    </div>
  </div>
</footer>


</body>
</html>
