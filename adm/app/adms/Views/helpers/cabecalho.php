<header>
    <div class="menu-bg">
        <div class="menu">

            <div class="menu__logo">
                <a > <img src="<?= URLADM . IMGADMCLINICA ?>logo.png" class="img-logo"></a>
            </div>

            <div class="espaco"></div>

            <nav class="nav">
                <ul class="nav__list">
                    <li><a href="<?= URLADM ?>AreaClientes/Dados" class="nav__link"> ÁREA CLIENTES </a> </li>
                    <li><a href="<?= URLADM ?>Servicos/Clinica" class="nav__link"> SERVICOS CLÍNICA </a> </li>
                    <a href="<?= URLADM ?>ConsultasAgendadas/Clientes"> <button class="botaoCab">SOLICITAÇÕES!</button> </a>
                </ul>
            </nav>

            <div class="nav__link">

                <div class="mobile-menu">
                  <div class="icone"> <i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i> </div>
                </div>

                <ul class="nav-list">
                  <a href="<?= URLADM . "Logout/logout" ?>" class="">Logout</a> 
                </ul>

                </nav> <!-- fim navbar -->
            </div>
        </div>
</header>