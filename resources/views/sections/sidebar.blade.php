 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        {{-- <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8"> --}}
        <span class="brand-text font-weight-light"><strong>MENU</strong> </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">Usuario</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
                {{-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="far fa-clipboard"></i>&nbsp;
                        <p>
                            FOJA DE CONCEPTO
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link class="nav-link" to='/'><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;<p>Habilitaciones</p> </router-link>
                        </li>
                        
                    </ul>
                </li> --}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="fas fa-school"></i>
                        <p>
                            COLEGIOS
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <!--to='INDICA EL PATH EN ARCHIVO routes.js'-->
                            <router-link class="nav-link" to='/listarColegios'><i class="fas fa-globe-americas"></i> &nbsp;&nbsp;<p>Colegios</p> </router-link>
                        </li>
                        <!--<li class="nav-item">
                            <router-link class="nav-link" to='/'><i class="far fa-address-card"></i> &nbsp;&nbsp;<p>Cargos</p> </router-link>
                        </li> -->
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="fas fa-user-graduate"></i>
                        <p>
                            ESTUDIANTES
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link class="nav-link" to='/listarEstudiantes'><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;<p>Estudiantes</p></router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to='/designarEstudiantes'><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;<p>Designación Estudiante</p></router-link>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
