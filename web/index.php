<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="homepage.css">
  <title>Tyler&apos;s Home Page</title>
</head>
<body>
  <header>
    <nav>
      <a href="https://www.byui.edu/">BYU-I</a> |
      <a href="https://www.w3schools.com">W3Schools</a> |
      <a href="https://www.nethack.org/">NetHack</a> |
      <a href="https://www.minecraft.net/">Minecraft</a>
    </nav>
  </header>
  <div id="title">
    <img src="me.png" alt="My beautiful face" />
    <h2>Welcome to</h2>
    <h1>TYLER STARR&apos;S</h1>
    <h2>home page</h2>
  </div>
  <div id="content">
    <p>My name is Tyler - welcome to my home page!
      I&apos;m a computer science student at BYU-Idaho in my junior year. I enjoy programming and software development,
      as well as website development. I enjoy cooking, baking, playing the piano, and playing video games! See the 
      navbar at the top of this page for links to two of my favorite games.
    </p>
    <p>
      The current time on the server is <b>
        <?php
          echo date("h:i:s A");
       ?></b>.
    </p>
  </div>
</body>
</html>