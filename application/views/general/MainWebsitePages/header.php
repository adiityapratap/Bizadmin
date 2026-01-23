<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>BizAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script> window.FontAwesomeConfig = { autoReplaceSvg: 'nest'};</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>::-webkit-scrollbar { display: none;}</style>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
   
    <script>
    tailwind.config = {
  "theme": {
    "extend": {
      "colors": {
        "primary": "#132f65",
        "accent": "#f97316"
      },
      "fontFamily": {
        "inter": [
          "Inter",
          "sans-serif"
        ],
        "sans": [
          "Inter",
          "sans-serif"
        ]
      }
    }
  }
};


 
     

</script>

   

  

  
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin=""><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;500;600;700;800;900&amp;display=swap"><style>
      body {
        font-family: 'Inter', sans-serif !important;
      }
      
      /* Preserve Font Awesome icons */
      .fa, .fas, .far, .fal, .fab {
        font-family: "Font Awesome 6 Free", "Font Awesome 6 Brands" !important;
      }
    </style>
    
    <style>
  .highlighted-section {
    outline: 2px solid #3F20FB;
    background-color: rgba(63, 32, 251, 0.1);
  }

  .edit-button {
    position: absolute;
    z-index: 1000;
  }

  ::-webkit-scrollbar {
    display: none;
  }

  html, body {
    -ms-overflow-style: none;
    scrollbar-width: none;
  }
  #timeline img{
      height:320px !important;
      width : 320px !important;
  }
  .laptopScreen img{
    border-radius: 8px;
    border: 8px solid black;
  }
  
   #mobile-menu {
            transform: translateX(100%);
        }
        #mobile-menu.is-open {
            transform: translateX(0);
        }
        #mobile-menu {
            transition: transform 300ms ease-in-out;
        }
  </style>
  
  </head>
  
  <html>
   
<body class="font-inter text-gray-800 ">
    <?php $this->load->view('general/MainWebsitePages/navbar'); ?>