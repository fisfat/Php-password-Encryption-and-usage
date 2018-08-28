<?php

###########################################################################
###########################################################################
###                                                                     ###
###     i found out that many people dont know this. This is a safer    ###
###     way of encrypting password in php using password_hash() func.   ###
###                                                                     ###
###########################################################################
###########################################################################

###################################################################################################
##      ENCRYPTING THE PASSWORD                                                                  ##
##                                                                                               ##
##      This takes in 3 parameters (The first 2 are compulsory while the third is optional;      ##
##      i. the password to be hashed, ii. the encryption algorithm, iii. Your prefered option    ##
##                                                                       (e.g you might decide   ##
##                                                                        to override the default##
##                                                                         salt value)           ##
##                                                                                               ##
##      The encryption algorithm includes;
##      1) PASSWORD_DEFAULT
##      2) PASSWORD_BCRYPT
##      3) PASSWORD_ARGON2I 
##
##      PASSWORD_DEFAULT doesn't support setting the third parameter.
##      PASSWORD_BCRYPT supports setting your cost and your salt value manually.
##      PASSRORD_ARGON2I supports setting memory cost, time cost and default thread.
##
## As at this time, PASSWORD_ARGON2I won't work with some hosting services because its not really
## supported yet. i will only show its usage without options.
###################################################################################################


###################################################################################################

                                /* CODE FOR ENCRYPTING THE PASSWORD */

    $password = 'provided_password';

        //using PASSWORD_DEFAULT
    $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);

        //using PASSWORD_BCRYPT without options(it will generate salt and cost automatically by default)
    $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);

        //using PASSWORD_BCRYPT with options (which i dont recommend)
    $options = [
        'cost' => 10, // setting cost to 10 is very good for some reasons
        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM), // Always set your salt value to be random at all time.
        // you can always decide to set either of them alone.
    ];
    $encryptedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
    
        //using PASSWORD_ARGON2I
    $encryptedPassword = password_hash($password, PASSWORD_ARGON2I);

    // read more about it from the php documentation: http://php.net/manual/en/function.password-hash.php 


############################################################################################################

                            /* CODE FOR VERIFYING THE PASSWORD */
// use the password_verify() function. This returns a boolean(true or false). 

  echo  password_verify($password, $encryptedPassword) ? 'Password correct' : 'Passwor incorrect';





