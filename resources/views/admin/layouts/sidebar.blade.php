<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="user-profile">
      <div class="user-image">
        <img src="{{asset('admin/template/images/faces/face28.png')}}">
      </div>
      <div class="user-name">
         Key Magic
      </div>
      <div class="user-designation">
          Developer
      </div>
    </div>
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="icon-box menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('roles.index')}}">
          <i class="icon-shuffle menu-icon"></i>
          <span class="menu-title">Role</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('users.index')}}">
          <i class="icon-head menu-icon"></i>
          <span class="menu-title">User</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="icon-paper menu-icon"></i>
          <span class="menu-title">Product</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="icon-file-add menu-icon"></i>
          <span class="menu-title">Category</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="icon-bag menu-icon"></i>
          <span class="menu-title">Order</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="icon-speech-bubble menu-icon"></i>
          <span class="menu-title">Comment</span>
        </a>
      </li>
  
    </ul>
  </nav>