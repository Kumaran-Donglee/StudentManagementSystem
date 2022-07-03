<!-- Sidebar (hidden by default) -->
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" style="display:none;z-index:2;width:40%;min-width:300px" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()"
  class="w3-bar-item w3-button">Close Menu</a>
  <a href="{{ route('students') }}" onclick="w3_close()" class="w3-bar-item w3-button">Student List</a>
  <a href="{{ route('students.marklist') }}" onclick="w3_close()" class="w3-bar-item w3-button">Student Mark List</a>
</nav>

<!-- Top menu -->
<div class="w3-top">
  <div class="w3-white w3-xlarge" style="max-width:1200px;margin:auto">
    <div class="w3-button w3-padding-16 w3-left" onclick="w3_open()">☰</div>
    <div class="w3-right w3-padding-16">Student List</div>
    <div class="w3-center w3-padding-16">Student Management System</div>
  </div>
</div>