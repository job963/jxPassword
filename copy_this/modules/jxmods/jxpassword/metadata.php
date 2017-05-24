<?php
/**
 * Metadata version
 */
$sMetadataVersion = '1.1';
 
/**
 * Module information
 * 
 * @link      https://github.com/job963/jxPassword
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @copyright (C) Joachim Barthel 2017
 * 
 **/

$aModule = array(
    'id'           => 'jxPassword',
    'title'        => 'jxPassword - Configurable Rules for Strong Passwords',
    'description'  => array(
                        'de' => '<b>Konfigurierbare Regeln für starke Passwörter</b><ul>'
                                . '<li>einstellbare Passwortlänge'
                                . '<li>konfigurierbare Regeln (Groß, Klein, Nummern, ...)'
                                . '<li>Prüfung auf Wiederholungen (Name, E-Mail, ..)</ul>',
                        'en' => '<b>Configurable password policy for strong passwords</b><ul>'
                                . '<li>Adjustable password length'
                                . '<li>Configurable rules (upper case, lower case, numbers, ...)'
                                . '<li>Check of repeatings (name, email, ...)</ul>',
                        ),
    'thumbnail'    => 'jxpassword.png',
    'version'      => '0.2.0',
    'author'       => 'Joachim Barthel',
    'url'          => 'https://github.com/job963/jxPassword',
    'email'        => 'jobarthel@gmail.com',
    'extend'       => array(
                            'oxinputvalidator'  =>  'jxmods/jxpassword/core/jxpassword_oxinputvalidator',
                            'oxuser'            =>  'jxmods/jxpassword/application/models/jxpassword_oxuser',
                            'account_password'  =>  'jxmods/jxpassword/application/controllers/jxpassword_account_password',
                        ),
    'files'        => array(
                            'jxpassword_oxinputvalidator' => 'jxmods/jxpassword/core/jxpassword_oxinputvalidator.php',
                            'jxpassword_oxuser'           => 'jxmods/jxpassword/application/models/jxpassword_oxuser.php',
                            'jxpassword_account_password' => 'jxmods/jxpassword/application/controllers/jxpassword_account_password.php',
                        ),
    'templates'     => array(
                        ),
    'blocks'        => array(
                            /*array( 
                                'template' => 'article_stock.tpl', 
                                'block'    => 'admin_article_stock_form',                     
                                'file'     => '/application/views/admin/blocks/admin_article_stock_form.tpl'
                              )*/
                        ),
    'events'       => array(
                            'onActivate'   => 'jxstockcollect_events::onActivate', 
                            'onDeactivate' => 'jxstockcollect_events::onDeactivate'
                        ),
   'settings'      => array(
                            array(
                                'group' => 'JXPASSWORD_PASSWORDSETTINGS', 
                                'name'  => 'sJxPasswordMinLength',  
                                'type'  => 'select', 
                                'value' => '8',
                                'constraints' => '6|7|8|9|10|11|12|13|14|15|16'
                                ),
                            array(
                                'group' => 'JXPASSWORD_PASSWORDSETTINGS', 
                                'name'  => 'bJxPasswordUpperCase',  
                                'type'  => 'bool', 
                                'value' => true
                                ),
                            array(
                                'group' => 'JXPASSWORD_PASSWORDSETTINGS', 
                                'name'  => 'bJxPasswordLowerCase',  
                                'type'  => 'bool', 
                                'value' => true
                                ),
                            array(
                                'group' => 'JXPASSWORD_PASSWORDSETTINGS', 
                                'name'  => 'bJxPasswordNumbers',  
                                'type'  => 'bool', 
                                'value' => true
                                ),
                            array(
                                'group' => 'JXPASSWORD_PASSWORDSETTINGS', 
                                'name'  => 'bJxPasswordSpecialChars',  
                                'type'  => 'bool', 
                                'value' => false
                                ),
                            array(
                                'group' => 'JXPASSWORD_PASSWORDSETTINGS', 
                                'name'  => 'sJxPasswordMinNumCharRules',  
                                'type'  => 'select', 
                                'value' => '3',
                                'constraints' => '1|2|3|4'
                                ),
                            array(
                                'group' => 'JXPASSWORD_PASSWORDRULES', 
                                'name'  => 'bJxPasswordMustBeDifferent',  
                                'type'  => 'bool', 
                                'value' => true
                                ),
                            array(
                                'group' => 'JXPASSWORD_PASSWORDRULES', 
                                'name'  => 'bJxPasswordMustntContainEmail',  
                                'type'  => 'bool', 
                                'value' => true
                                ),
                            array(
                                'group' => 'JXPASSWORD_PASSWORDRULES', 
                                'name'  => 'bJxPasswordMustntContainCustNo',  
                                'type'  => 'bool', 
                                'value' => true
                                ),
                            array(
                                'group' => 'JXPASSWORD_PASSWORDRULES', 
                                'name'  => 'bJxPasswordMustntContainName',  
                                'type'  => 'bool', 
                                'value' => true
                                ),
                            array(
                                'group' => 'JXPASSWORD_PASSWORDRULES', 
                                'name'  => 'bJxPasswordMustntContainAddress',  
                                'type'  => 'bool', 
                                'value' => true
                                ),
                            array(
                                'group' => 'JXPASSWORD_PASSWORDRULES', 
                                'name'  => 'bJxPasswordMustntContainBirthday',  
                                'type'  => 'bool', 
                                'value' => true
                                ),
                        )
);
