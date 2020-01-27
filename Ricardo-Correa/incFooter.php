</body>
<?php
  if(isset($_SESSION['msg'])){
      if($_SESSION['msg'] != ""){
      echo  '<scr' . 'ipt>alert("' . $_SESSION['msg'] . '");</scr' . 'ipt>';
      $_SESSION['msg'] = "";
      }
      echo $_SESSION['msg'];
  }
?>
