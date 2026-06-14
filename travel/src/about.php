<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dist/output.css">
    <link rel="stylesheet" href="dist/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/scrollreveal"></script>

    <style>
      @import url('https://fonts.cdnfonts.com/css/arial-rounded-mt-bold');
      body{
        font-family: "Arial Rounded MT Bold", sans-serif;
      }
      html{
        scroll-behavior: smooth;
      }
      .cardhover{
        transition: 0.8s ease-in-out;
      }
      .cardhover:hover{
        transform: translateY(-2px) scale(1.1);
      }
      .iconhover{
        transition: 0.2s ease-in-out;
      }
      .iconhover:hover{
        transform: scale(1.1);
      }
      .buttonhover{
        transition: 0.3s ease-in-out;
      }
      .buttonhover:hover{
        transform: scale(1.07);
      }
      .typing-animation::after {
        content: "|";
        animation: typing 1s steps(1) infinite;
      }
      @keyframes typing {
        0% { opacity: 0; }
        50% { opacity: 1; }
        100% { opacity: 0; }
      }
    </style>

  </head>
    
<body class="bg-[#000000] animate">


<!-- Header include -->
<?php 
    include_once('includes/header.php');
    ?>
<!-- END Header include -->    


<!-- about section -->

<div class="container my-14 mx-auto md:px-6">
  <section class="mb-20">

    <h3 id="title" class="bottom_come flex items-center my-8 px-[4%] md:px-[10%] pb-10">
      <span aria-hidden="true" class="grow bg-gradient-to-r from-[#171616] to-[#1F1E1E]  border-none rounded h-0.5 mr-4"></span>
      <span class="text-4xl text-white font-semibold mx-3 capitalize">about us</span>
      <span aria-hidden="true" class="grow bg-gradient-to-r from-[#1F1E1E] to-[#171616]  border-none rounded h-0.5 ml-4"></span>
    </h3>

    <div class="mb-16 flex flex-wrap left_come">
      <div class="mb-6 w-full shrink-0 grow-0 basis-auto lg:mb-0 lg:w-6/12 lg:pr-6">
        <div class="ripple relative overflow-hidden rounded-lg bg-cover bg-[50%] bg-no-repeat shadow-lg">
          <img src="../src/assets/img/14.jpeg" class="cardhover w-full" alt="image" />
        </div>
      </div>

      <div class="w-full shrink-0 grow-0 basis-auto lg:w-6/12 lg:pl-6 ">
        <h3 class="mb-4 text-2xl font-bold bg-gradient-to-r from-cyan-500 to-blue-600 text-transparent bg-clip-text p-4 rounded-md capitalize">our vision!</h3>
          
        <p class="text-gray-200">
        



Our travel website is dedicated to transforming the way people explore the world by offering a 
seamless, personalized experience. We provide tailored travel recommendations based on individual interests, along with 
immersive virtual tours and high-quality visuals to help users experience destinations before booking. Our streamlined booking
 process simplifies travel planning, while community-driven insights and eco-friendly options ensure informed, responsible choices.
  With real-time support, inspiring travel content, and global accessibility, our platform embraces the latest technology to enhance 
  every journey.
        </p>
      </div>
    </div>

    <div class="mb-16 flex flex-wrap lg:flex-row-reverse right_come">
      <div class="mb-6 w-full shrink-0 grow-0 basis-auto lg:mb-0 lg:w-6/12 lg:pl-6">
        <div class="ripple relative overflow-hidden rounded-lg bg-cover bg-[50%] bg-no-repeat shadow-lg">
          <img src="../src/assets/img/24.jpeg" class="cardhover w-full" alt="image" />
        </div>
      </div>

      <div class="w-full shrink-0 grow-0 basis-auto lg:w-6/12 lg:pr-6">
        <h3 class="mb-4 text-2xl font-bold bg-gradient-to-r from-cyan-500 to-blue-600 text-transparent bg-clip-text p-4 rounded-md capitalize"">our mission</h3>
    
        <p class="text-gray-200">
        



Our mission is to inspire and empower travelers by providing personalized, insightful, and accessible travel guidance. We strive to make travel planning effortless and enjoyable through curated recommendations, immersive content, and real-time support. By fostering a community of explorers and promoting sustainable choices, we aim to enrich every journey and connect people with the world in meaningful ways.


      </div>
    </div>

   


    <div class="mb-16 flex flex-wrap lg:flex-row-reverse right_come">
      <div class="mb-6 w-ful shrink-0 grow-0 basis-auto lg:mb-0 lg:w-6/12 lg:pl-6">
        <div class="m-full  ripple relative overflow-hidden rounded-lg bg-cover bg-[100%] bg-no-repeat shadow-lg">
          <img src="../src/assets/img/35.png" class="cardhover w-full h-full" alt="image" />
        </div>
      </div>

      <div class="w-100 shrink-0 grow-0 basis-auto lg:w-6/12 lg:pr-6">
        <h1 class="mb-4 text-3xl font-bold bg-gradient-to-r from-cyan-500 to-blue-600 text-transparent bg-clip-text p-4 rounded-md capitalize">our team</h1>
    
        <p class="text-gray-200 text-lg">
        At Explore Matale, we are passionate travelers, local enthusiasts, and cultural ambassadors dedicated to showcasing the hidden gems of the beautiful Matale District. Our team comprises individuals with diverse expertise, all united by one goal: to provide visitors with authentic and enriching experiences that highlight the natural beauty, rich history, and vibrant culture of this region.

Who We Are
Local Experts: Our team includes long-time residents of the Matale District, each bringing invaluable knowledge of the area's landscapes, traditions, and secret spots that only locals know.

Travel Enthusiasts: From adventure seekers to culture explorers, our members have traveled extensively and understand what makes a destination truly special. We are committed to curating unique travel experiences for our visitors.
        </p>
      </div>
    </div>
  </section>
</div>

<!-- about section end -->


<!-- subscribe section -->
<?php
include('includes/subscribe.php');
?>
<!-- subscribe section end -->


<!-- footer include -->
<?php
include_once('includes/footer.php');
?>
<!-- footer include end -->



<script>
    ScrollReveal({ 
    reset: false,
    distance: '60px',
    duration: 2500,
    dilay: 200
   });
  
     ScrollReveal().reveal('.left_come', { delay: 300, origin: 'left' });
     ScrollReveal().reveal('.right_come', { delay: 300, origin: 'right' });
     ScrollReveal().reveal('.top_come', { delay: 300, origin: 'top' });
     ScrollReveal().reveal('.bottom_come', { delay: 300, origin: 'bottom' });
  </script>


</body>
</html>