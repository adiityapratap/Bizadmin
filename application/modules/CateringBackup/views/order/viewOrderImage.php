<div class="main-content">
<div class="page-content">
<div class="container-fluid">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css">

<div class="row">
					<!--Report widget start-->
					<div class="col-12">
						<div class="card card-shadow mb-4">
							<div class="card-header">
								<h3 class="card-title">Order Attachments</h3>
							</div>
							<div class="card-body">
							    <?php if(!empty($orderImages)){ ?>
								 <div class="row d-flex gap-2 ">
								   
							 <?php foreach($orderImages as $img){ ?>	
							 
								   <?php
        $fileUrl = base_url() . 'uploadedFiles/' . $img['order_image'];
        $fileExtension = pathinfo($fileUrl, PATHINFO_EXTENSION);

        if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
            // Display image
            echo '<a href="' . $fileUrl . '" target="_blank" class="col-3 border-solid"><img class="w-100" src="' . $fileUrl . '"></a>';
        } elseif ($fileExtension === 'pdf' || $fileExtension === 'doc' || $fileExtension === 'docx') {
            // Display PDF icon or link
            echo '<a href="' . $fileUrl . '" target="_blank" class="col-3">'.$img['order_image'].'</a>';
        } else {
            // Handle other file types or provide an error message
            echo 'Unsupported file type';
        }
        ?>  
			 <?php } ?>					     
								     
					 </div>
                                  <?php }else{ ?>
                                  <p>No images found</p>
                                  <?php } ?>
							</div>
						</div>
					
					</div>
					<!--Report widget end-->
				</div>
		
		
</div>
</div>
</div>  

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
  $('.responsive').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
	
</script>




