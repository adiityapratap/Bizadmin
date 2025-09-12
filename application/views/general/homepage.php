
<?php $this->load->view('general/MainWebsitePages/header'); ?>  
   
  

    <div class="dynamic-content-wrapper" id="dynamic-content-wrapper">
  <?php echo $landingPageContent; ?>
   
    </div>
    
    
   <?php $this->load->view('general/MainWebsitePages/footer'); ?>   
   <div id="scroll-to-top" class="fixed bottom-4 right-4 bg-accent rounded-full p-3 shadow-lg z-50">
        <span class="text-white hover:text-primary transition-colors cursor-pointer">
            <i class="fa-solid fa-arrow-up text-2xl"></i>
        </span>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const scrollToTop = document.getElementById('scroll-to-top');
            if (scrollToTop) {
                scrollToTop.addEventListener('click', (e) => {
                    e.preventDefault();
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        });
    </script>
    
    
    
    
    

