<div id="sidebar">
  <div class="top-menu">
    <button class="settings" onclick="window.location='index.php'"><i class="fa fa-home" aria-hidden="true"></i></button>

    <!-- 
      settings can provide dropdown menu for
      - logout (redirects to logout.php, session ends)
      -   
   -->
    <button class="settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" href="pass-change.php">Change Password</a>
      <a class="dropdown-item" href="login.php">Logout</a>
    </div> 

    <div class="upload">
      <div>
        <i class="fa fa-upload" aria-hidden="true"></i> 
        <span>UPLOAD</span>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="searchbar">
      <i class="fa fa-search" aria-hidden="true"></i>
      <input id="side-searchbar" class="search" type="text" placeholder="Search here...">
    </div>
    <ul class="options">
      <li>FILTERS</li>
      <hr>
      <li>
        <ul class="filters">
          <li>Date</li>
            <ul>
              <!-- <li class="sub-filter">
                <div class="right-icon drop" data-toggle="collapse" data-target="#months">
                  <div class="title">Month</div>
                  <span class="icon">+</span>
                </div>
              </li>
              <div id="months" class="collapse sub-dropdown">
                <ul>
                  <?php 
                    $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

                    foreach ($months as $month) {
                      echo createFilterCheckbox($month);
                    }
                  ?>
                </ul>
              </div> -->
              <li class="sub-filter">
                <div class="right-icon drop">
                  <div class="title">Year</div>
                  <!-- <span class="icon">+</span> -->
                </div>
              </li>
              <div id="years" class="sub-dropdown">
                <ul id="years-list">
                </ul>
              </div>
            </ul>
          <!-- <li>Media Type</li>
          <div class="sub-dropdown">
            <ul>
              <?php 
                $mediaTypes = array('Images', 'Videos', 'Vectors', 'Miscellaneous');

                foreach ($mediaTypes as $type) {
                  echo createFilterCheckbox($type);
                }
              ?>
            </ul>
          </div> -->
          <li>Event Name</li>
          <div class="sub-dropdown">
            <ul id="events-list">
            </ul>
          </div>
          <!-- <li>Event Type</li> -->
        </ul>
      </li>
    </ul>
  </div>
</div>