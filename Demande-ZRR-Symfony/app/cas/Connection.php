<?php


phpCAS::setVerbose(true);
phpCAS::client(CAS_VERSION_2_0, 'auth.univ-orleans.fr', 443, 'cas');

phpCAS::setServerServiceValidateURL('https://auth.univ-orleans.fr/cas/p3/serviceValidate');
phpCAS::setFixedServiceURL('https://pdicost.univ-orleans.fr/appli-jpo/');
phpCAS::setServerServiceValidateURL('https://auth.univ-orleans.fr/cas/serviceValidate');
phpCAS::setNoCasServerValidation();
phpCAS::forceAuthentication();

if(phpCAS::getUser()){
  return phpCAS::getUser();
  // echo "L'utilisateur : ".." est connecte";  
  // //var_dump($_SERVER);
}



