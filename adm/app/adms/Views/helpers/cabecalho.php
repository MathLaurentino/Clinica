
<header>
    <div class="menu-bg">
        <div class="menu">

            <div class="menu__logo">
                <a href="<?= URLADM ?>Home"> <img src="<?= URLADM . IMGADMSER ?>logo.png" class="img-logo"></a>
            </div>

            <div class="espaco"></div>

            <nav class="nav">
                <ul class="nav__list">
                    <li><a href="<?= URLADM ?>AreaClientes/Dados" class="nav__link"> ÁREA CLIENTES </a> </li>
                    <li><a href="<?= URLADM ?>Servicos/Clinica" class="nav__link"> SERVICOS CLÍNICA </a> </li>
                    <a href="<?= URLADM ?>ConsultasAgendadas/Clientes"> <button class="botaoCab">SOLICITAÇÕES!</button> </a>
                </ul>
            </nav>

            <div class="nav">
                <ul class="nav__list">
                    <li><a href="<?= URLADM . "Logout/logout" ?>" class="nav__link">LOG OUT</a> </li>
                </ul>
            </div>
        </div>
    </div>
</header>