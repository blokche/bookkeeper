<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $this->url('admin.home'); ?>">Dashboard <i class="fa fa-cog" aria-hidden="true"></i></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo $this->url('admin.user');?>">Utilisateurs</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Livres <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->url('admin.book');?>">Consulter les livres</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo $this->url('admin.book.add');?>">Ajouter un livre</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catégories <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->url('category.home');?>">Consulter les catégories</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo $this->url('category.add');?>">Ajouter une catégorie</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo $this->url('profile.home'); ?>">Profil public <i class="fa fa-user-o" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo $this->url('auth.logout'); ?>">Logout <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>