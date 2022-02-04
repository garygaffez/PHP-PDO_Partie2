<?php

// regex pour email pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"

// REGEX pour : prenom, nom
    define("REG_STR_NO_NUMBER", "^[a-zÀ-ÿA-Z '-]+$");

// REGEX pour textarea
    define("REG_STR_NO_BALISE", "^[a-zÀ-ÿA-Z0-9?$@#() '\"!,+\-=_:.&€£*%\s]+$");

// REGEX pour adresse postale
    define("REG_STR_NUMBER_AND_STRING", "^[a-zÀ-ÿA-Z0-9 '-]+$");

// REGEX pour code postal
    define("REG_STR_ZIPNUMBER", "^[A-Z0-9]{1,2} ?[A-Z0-9]{3}$");

// REGEX pour code postal
    define("REG_STR_PHONENUMBER", "^[0-7]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}$");

// REGEX pour code postal
    define("REG_STR_POLENUMBER", "^[A-Z0-9]{8}$");