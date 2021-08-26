<!-- Header section -->
    <header>
        <a class="logo" href="#">Contest</a>
        <nav>
          <li><a href="index.php">Home</a></li>
          <li><a class="start-btn" href="#get-started">Get Started</a></li>
          <li><a href="logout.php">Logout</a></li>
        </nav>
        <div onclick="toggle()" class="bars">
          <div class="bar1"></div>
          <div class="bar2"></div>
          <div class="bar3"></div>
        </div>
    </header>

  <script type="text/javascript" charset="utf-8">
    function toggle() {
      let navigation =
        document.querySelector('header nav');
      let bars = document.querySelector('header .bars');

      if (navigation.style.transform === "scaleX(1)") {
        navigation.style.transform = "scaleX(0)";
        bars.classList.remove('change');
      }
      else {
        navigation.style.transform = "scaleX(1)";
        bars.classList.add('change');
      }
    }
  </script>