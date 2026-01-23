 <?php 
 //  we have a common footer for all the Apps like HR, Cash , Supplier etc where we load all our asset JS
     $allJsSourceFiles = APPPATH . 'views/general/AllJs.php';
     include($allJsSourceFiles);
     
?>
<script>
function explode(){
      $('.hideMeAlert').remove();
      <?php 
        $this->session->unset_userdata('sucess_msg');
        $this->session->unset_userdata('error_msg');
        ?>
    }
    setTimeout(explode, 2000);
    
function goBack() {
    window.history.back();
}   
</script>