<?php
  session_start();
  session_destroy();
  echo "<script>alert('Anda telah keluar dari Website'); window.location = 'index.php'</script>";
?>
