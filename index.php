    <!DOCTYPE html>
<html lang="zh-CN">
  <?php 
session_start();
if (!isset($_SESSION['user'])){
    header('location:welcome.php');
    exit();
}
?>
<!DOCTYPE html>
***
***
<!-- 页面主体内容 -->
    <div class="container">
      <div class="content">
          <div class="starter-template">
             <!-- 这里做了修改，其他地方自由发挥 -->
            <h1>Welcome To ShiYanLou</h1>
            <div class="jumbotron">
              <!-- 打印用户名 -->
              <h1>Hello, <?php echo $_SESSION['user']; ?>admin</h1>
              <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
              <p><a class="btn btn-primary btn-lg" href="http://www.shiyanlou.com" role="button">Learn more</a></p>
            </div>
          </div>  
      </div>
    </div><!-- /.container -->

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">ShiYanLou</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <?php 
              if (!isset($_SESSION['user'])) {
           ?>
            <li><a href="#Register" data-toggle="modal" data-target="#register">Register</a></li>
            <li><a href="#Register" data-toggle="modal" data-target="#login">Login</a></li>
            <?php
               }else{ 
             ?>
              <li><a href="http://www.shiyanlou.com" >Learn</a></li>
              <li><a href="admin/Logout.php" >Logout</a></li>
            <?php
               } 
             ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    
    <?php include_once './public/layout/footer.php'; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="public/js/check.js"></script>
  </body>
</html>
