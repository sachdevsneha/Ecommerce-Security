<?php

/**
 * These are the database login details
 */
define("HOST", "localhost"); 			// The host you want to connect to. 
define("USER", "sporty_user"); 			// The database username.
define("PASSWORD", "eKcGZr59zAa2BEWU"); // The database password.
define("DATABASE", "sporty");     // The database name.

/**
 * Who can register and what the default role will be
 * Values for who can register under a standard setup can be:
 *      any  == anybody can register (default)
 *      admin == users must be registered by an administrator
 *      root  == only the root user can register users
 *
 * Values for default role can be any valid role, but it's hard to see why
 * the default 'user' value should be changed under the standard setup.
 * However, additional roles can be added and so there's nothing stopping
 * anyone from defining a different default.
 */
define("CAN_REGISTER", "admin");
define("DEFAULT_ROLE", "user_info");

/**
 * Is this a secure connection?  The default is FALSE, but the use of an
 * HTTPS connection for logging in is recommended.
 *
 * If you are using an HTTPS connection, change this to TRUE
 */
define("SECURE", FALSE);    // For development purposes only!!!!

