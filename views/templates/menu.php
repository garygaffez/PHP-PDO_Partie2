<nav class="navbar is-link" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="../../controllers/home-controller.php">
        <!-- <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28"> -->
        </a>

        <a role="button" class="navbar-burger mr-3" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="../../controllers/home-controller.php">Home</a>

            
        <div class="container is-fluid">
            <div class="columns">

            <div class="column is-6">           
                <div class="navbar-item has-dropdown is-hoverable m-3">
                <a class="navbar-link">Patients</a>
                <div class="navbar-dropdown">
                    <a class="navbar-item" href="/controllers/ajout-patient-controller.php">Ajouter un patient</a>
                    <a class="navbar-item" href="/controllers/liste-patients-controller.php">Liste des patients</a>
                </div>
                </div>
            </div>

            <div class="column is-6">
                <div class="navbar-item has-dropdown is-hoverable m-3">      
                <a class="navbar-link">Rendez-vous</a>
                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="/controllers/ajout-rendezvous-controller.php">Ajouter un rendez-vous</a>
                        <a class="navbar-item" href="/controllers/liste-rendezvous-controller.php">Liste des rendez-vous</a>
                    </div>
                </div>
            </div>

            <div class="column is-6">
                <div class="navbar-item m-1">      
                    <a class="navbar-link" href="/controllers/ajout-patient-rendezvous-controller.php">Ajout Patient et rendez-vous</a>
                </div>
            </div>


        </div>
    </div>

    
</nav>