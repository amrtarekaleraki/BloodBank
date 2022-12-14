<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Blood Bank</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{auth()->user()->name}}</a>
          </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

              <li class="nav-item">
              <a href="{{route('governorate.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                      Governorates
                  </p>
                  </a>
              </li>

              <li class="nav-item">
                <a href="{{route('bloodtype.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        BloodTypes
                    </p>
                    </a>
                </li>

              <li class="nav-item">
                  <a href="{{route('city.index')}}" class="nav-link">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                          Cities
                      </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{route('category.index')}}" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Categories
                          </p>
                          </a>
                      </li>


                  <li class="nav-item">
                      <a href="{{route('post.index')}}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Posts
                          </p>
                          </a>
                      </li>

                      <li class="nav-item">
                        <a href="{{route('client.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Clients
                            </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{route('donationrequest.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Donation Requests
                                </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('contact.index')}}" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Contacts
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('user.index')}}" class="nav-link">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>
                                            users
                                        </p>
                                        </a>
                                    </li>





            {{-- <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../../index.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dashboard v1</p>
                  </a>
                </li>
              </ul>
            </li> --}}

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->

  </aside>
