    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/all.min.js"></script>
    <script src="js/bootstrap-4.3.1.js"></script>
      
      <script type="text/javascript">
          $(document).ready(function(){
                        var stmt = 1;
          $("#drop_").click(function(){
              if(stmt) {
                $(".drop-dowsn-items").addClass("opened");
                  stmt = 0 ;
              }else{
                  $(".drop-dowsn-items").removeClass("opened");
                  stmt = 1;
              }
          });

          });
      </script>
  </body>
</html>
