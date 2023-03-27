<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>My Ribbit</title>
</head>
<body>
<?php
   include "data.php";
?>
    <header>
        <h1>Ribbit</h1>
      </header>
      <nav>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">Login</a></li>
          <li><a href="register.html">Register</a></li>
          <li><a href="#">Profile</a></li>
          <li><a href="#">Settings</a></li>
          <li><input type="search" name="item" placeholder="Search Bar"></li>
        </ul>
      </nav>
      <main>
        <p id="create" align="center"><a href="post.html"> Create A Post</a></p>
        <section id="posts">
          <h2> All Posts</h2>
          <ul>
            <li>
                <article>
                    <p> Phil Dunphy <br>
                        <strong>Date:</strong> 
                        <time>March 14th, 2023</time><br>
                        <strong>Title:</strong> Hello everyone!
                    </p>
                    <p> Hello everyone! I'm new here and I just wanted 
                        to introduce myself. I'm Phil and I'm interested in real estate and games. I hope 
                        to learn from you all and share my wisdom too.
                    </p>
                    <p><a href="#">Comment</a></p>
                </article>
            </li>
            <li>
                <article>
                    <p> Jay Pritchett <br>
                        <strong>Date:</strong>
                        <time>March 14th, 2023</time><br>
                        <strong>Title:</strong>Not Welcome!
                    </p>
                    <p>Go away Phil! This is a great place to learn and discuss, try not to ruin it!
                    </p>
                    <p><a href="#">Comment</a></p>
                </article>
            </li>
            
            <li>
                <article>
                    <p> Alex Dunphy <br>
                        <strong>Date:</strong>
                        <time>March 14th, 2023</time><br>
                        <strong>Title:</strong>What are you doing?
                    </p>
                    <p>What are you both doing in my astronomy club with my friends? We are discussing neutrons here here.
                    </p>
                    <p><a href="#">Comment</a></p>
                </article>
            </li>
        </ul>
    </section>
    <section id="Astronomy">
        <h2>#Astronomy</h2>
        <ul>
            <li>
                <article>
                    <p> Alex Dunphy <br>
                        <strong>Date:</strong>
                        <time>March 14th, 2023</time><br>
                        <strong>Title:</strong>Neutron Stars
                    </p>
                    <p>Hi everyone! I'm writing this post to let you all know that the A6 assignement that was due on <time>March 21th, 2023</time>
                        is completed and we should start working on developing pulsar formula for Neutron stars and black holes.<br> Thanks
                    </p>
                    <p><a href="#">Comment</a></p>
                </article>
            </li>
        
            <li>
                <article>
                    <p> Haley Dunphy <br>
                        <strong>Date:</strong>
                        <time>March 14th, 2023</time><br>
                        <strong>Title:</strong>HI ALEX!
                    </p>
                    <p>Hey, I have taken a screenshot of these nerdy words and uploaded to my post, be sure to like it! 
                    </p>
                    <p><a href="#">Comment</a></p>
                </article>
            </li>
            <li>
                <article>
                    <p> Luke Dunphy <br>
                        <strong>Date:</strong>
                        <time>March 14th, 2023</time><br>
                        <strong>Title:</strong>High five!
                    </p>
                    <p>What a post Haley! Seriously, where is the post, I can't access it! Have you blocked me?
                    </p>
                    <p><a href="#">Comment</a></p>
                </article>
            </li>
        </ul>
    </section>
</main>
<footer>
    <p>&copy; 2023 Ribbit. All rights reserved.</p>
    <p><a href="#">About Us</a></p>
    <p><a href="#">Contact</a></p>
</footer>
    
</body>
</html>