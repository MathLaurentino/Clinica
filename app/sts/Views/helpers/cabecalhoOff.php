<header>
    <div class="menu-bg">
        <div class="menu">

            <div class="menu__logo">
                <a href="<?= URL ?>Home"> <img src="<?= URL . IMGCLINICA ?>logo.png" class="img-logo"> </a>
            </div>

            <div class="espaco"></div>

            <nav class="nav">
                <ul class="nav__list">
                    <li><a href="<?= URL ?>Home" class="nav__link">HOME</a> </li>
                    <li><a href="<?= URL ?>CadastroPet/Cadastro" class="nav__link">CADASTRAR PET</a> </li>
                    <li><a href="<?= URL ?>Sobre-Cliente/Dados" class="nav__link">ÁREA CLIENTE</a> </li>
                    <a href="<?= URL ?>Servicos"> <button class="botaoCab">AGENDE AQUI!</button> </a>
                </ul>
            </nav>

            <div class="alinhamentoHeader">
                <div class="nav__link">

                    <div class="mobile-menu">
                        <div class="icone"> <i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i> </div>
                    </div>

                    <div class="nav-list">
                        <a href="<?= URL . "Login" ?>" class="">Login</a>
                        <a href="<?= URL . "Cadastro/Usuario" ?>" class="">Cadastro</a>
                    </div>

                </div>
            </div>

        </div>
</header>