<?php 
error_reporting(0);
ob_start();
include'config.php';

if(!get_session()) {

//user_logout();
?>
<script>
window.location.href = "page.php?page=login";
</script>
<?php
}

?>

