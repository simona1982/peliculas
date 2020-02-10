<div id="navigation">
    <div class="profile-picture">

        <a href="#">
            <img src="{{ url('image-user', [Auth::user()->picture]) }}" class="img-circle m-b" alt="logo" width="80" height="80">
        </a>

        <div class="stats-label text-color">
            <span class="font-extra-bold font-uppercase">
                {{ Auth::user()->username }}
            </span>

            <div class="dropdown">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                    <small class="text-muted">Links <b class="caret"></b></small>
                </a>
                <ul class="dropdown-menu animated flipInX m-t-xs">
                    <li><a href="#">Example link</a></li>
                    <li><a href="#">Example link</a></li>
                </ul>
            </div>

            <div id="sparkline1" class="small-chart m-t-sm"></div>
            <div>
                <h4 class="font-extra-bold m-b-xs">
                    $260 104,200
                </h4>
                <small class="text-muted">
                    ventas del ultimo mes en Punto X
                </small>
            </div>


        </div>
    </div>

    <ul class="nav" id="side-menu">
        <li class="active">
            <a href="index.html"> 
                <span class="nav-label">
                    <font-awesome-icon iconPrefix="fas" icon="user"></font-awesome-icon>
                    Usuarios
                </span> 
                <span class="label label-success pull-right">start</span> 
            </a>
            <ul class="nav nav-second-level">
                <li><a href="{{ route('users.index') }}">Listar</a></li>
                <li><a href="{{ route('users.create') }}">Crear</a></li>
            </ul>
        </li>
        <li>
            <a href="index.html"> 
                <span class="nav-label">
                    <font-awesome-icon icon="store"></font-awesome-icon>
                    Peliculas
                </span> 
                <!--span class="label label-success pull-right">start</span--> 
            </a>
            <ul class="nav nav-second-level">
                <li><a href="{{ route('points-sale.index') }}">Listar</a></li>
                <li><a href="{{ route('points-sale.create') }}">Crear</a></li>
            </ul>
        </li>
        <li>
            <a href="page2.html"> 
                <span class="nav-label">
                    <font-awesome-icon icon="user-tie"></font-awesome-icon>
                    Clientes
                </span> 
            </a>
            <ul class="nav nav-second-level">
                <li><a href="{{ route('clients.index') }}">Listar</a></li>
                <li><a href="{{ route('clients.create') }}">Crear</a></li>
            </ul>
        </li>
        <li>
            <a href="page2.html"> 
                <span class="nav-label">
                    <font-awesome-icon icon="calendar-plus"></font-awesome-icon>
                    Reservaciones
                </span> 
            </a>
            <ul class="nav nav-second-level">
                <li><a href="{{ route('reservations.index') }}">Listar</a></li>
                <li><a href="{{ route('reservations.create') }}">Crear</a></li>
            </ul>
        </li>
       
    </ul>
</div>