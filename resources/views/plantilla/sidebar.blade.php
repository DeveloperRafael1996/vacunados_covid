<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
            </li>
            <li class="nav-title">
                Mantenimiento
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> R. Generales</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=1" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>V. Grupo Riesgo</a>
                    </li>
                    <li  @click="menu=2" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>V. Frabricante</a>
                    </li>
                    <li  @click="menu=3" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>V. Rango Edades</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> R. Especificos</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=4" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>VD Grupo Riesgo</a>
                    </li>
                    <li @click="menu=5" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>VD Sector</a>
                    </li>
                    <li @click="menu=6" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>VD Fabricante</a>
                    </li>

                    <li @click="menu=9" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>VD Provincia</a>
                    </li>
                    
                    <li @click="menu=8" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>VD Distrito</a>
                    </li>

                    <li @click="menu=7" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>V. Paciente</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Importar </a>
                <ul class="nav-dropdown-items">
                    <li   href="{{ route('import')}}"   class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i>Subir Excel</a>
                    </li>
                </ul>
            </li>
            
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>