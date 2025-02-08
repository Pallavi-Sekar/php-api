<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecommerce API Documentation</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f3f4f6;
      color: #333;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }
    .container {
      background: #ffffff;
      max-width: 600px;
      width: 100%;
      padding: 30px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      border-radius: 12px;
    }
    h1 {
      text-align: center;
      color: #0078d4;
      margin-bottom: 15px;
    }
    p {
      text-align: center;
      color: #666;
      margin-bottom: 20px;
    }
    ul {
      list-style: none;
      padding: 0;
    }
    li {
      background-color: #0078d4;
      color: white;
      padding: 12px 15px;
      border-radius: 8px;
      margin: 8px 0;
      text-align: center;
    }
    li a {
      color: white;
      text-decoration: none;
      font-weight: bold;
    }
    footer {
      text-align: center;
      font-size: 14px;
      margin-top: 20px;
      color: #999;
    }
    footer a {
      color: #0078d4;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Ecommerce API Documentation</h1>
    <p>Access different API endpoints for testing and development:</p>
    <ul>
      <li><a href="api/products.php">Product Management</a></li>
      <li><a href="api/users.php">User Management</a></li>
      <li><a href="api/comments.php">Comments on Products</a></li>
      <li><a href="api/cart.php">User Cart Operations</a></li>
      <li><a href="api/orders.php">Order Processing</a></li>
    </ul>
    <footer>
      <p>Built by Team <a href="#">PHP Masters</a></p>
    </footer>
  </div>
</body>
</html>
