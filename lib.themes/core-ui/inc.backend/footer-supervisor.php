
          </div>
        </div>
      <footer class="footer px-3">
        <div>© 2017-<?php echo date('Y');?></div>
        <div class="ms-auto">Powered by <a href="https://planetbiru.com">Planetbiru Studio</a></div>
      </footer>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/simplebar/js/simplebar.min.js"></script>
    <script src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
      const header = document.querySelector('header.header');
      document.addEventListener('scroll', () => {
        if (header) {
          header.classList.toggle('shadow-sm', document.documentElement.scrollTop > 0);
        }
      });
    </script>
  </body>
</html>