<?php
echo "<script>
    localStorage.removeItem('jwtToken');
    window.location.href = '?page=login';
</script>";
?>
