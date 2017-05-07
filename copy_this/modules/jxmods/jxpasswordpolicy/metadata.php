<?php
/**
 * Metadata version
 */
$sMetadataVersion = '1.1';
 
/**
 * Module information
 * 
 * @link      https://github.com/job963/jxPasswordPolicy
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @copyright (C) Joachim Barthel 2017
 * 
 **/

$aModule = array(
    'id'           => 'jxPasswordPolicy',
    'title'        => 'jxPasswordPolicy - Configurable Rules for Strong Passwords',
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
    'thumbnail'    => 'jxpasswordpolicy.png',
    'version'      => '0.1.0',
    'author'       => 'Joachim Barthel',
    'url'          => 'https://github.com/job963/jxPasswordPolicy',
    'email'        => 'jobarthel@gmail.com',
    'extend'       => array(
                            'oxinputvalidator'  =>  'jxmods/jxpasswordpolicy/core/jxpasswordpolicy_oxinputvalidator',
                            'oxuser'            =>  'jxmods/jxpasswordpolicy/application/models/jxpasswordpolicy_oxuser',
                            'account_password'  =>  'jxmods/jxpasswordpolicy/application/controllers/jxpasswordpolicy_account_password',
                        ),
    'files'        => array(
                            'jxpasswordpolicy_oxinputvalidator' => 'jxmods/jxpasswordpolicy/core/jxpasswordpolicy_oxinputvalidator.php',
                            'jxpasswordpolicy_oxuser'           => 'jxmods/jxpasswordpolicy/application/models/jxpasswordpolicy_oxuser.php',
                            'jxpasswordpolicy_account_password' => 'jxmods/jxpasswordpolicy/application/controllers/jxpasswordpolicy_account_password.php',
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
                                'group' => 'JXPASSWORDPOLICY_PASSWORDSETTINGS', 
                                'name'  => 'sJxPasswordPolicyMinLength',  
                                'type'  => 'select', 
                                'value' => '8',
                                'constraints' => '6|7|8|9|10|11|12|13|14|15|16'
                                ),
                            array(
                                'group' => 'JXPASSWORDPOLICY_PASSWORDSETTINGS', 
                                'name'  => 'bJxPasswordPolicyUpperCase',  
                                'type'  => 'bool', 
                                'value' => true
                                ),
                            array(
                                'group' => 'JXPASSWORDPOLICY_PASSWORDSETTINGS', 
                                'name'  => 'bJxPasswordPolicyLowerCase',  
                                'type'  => 'bool', 
                                'value' => true
                                ),
                            array(
                                'group' => 'JXPASSWORDPOLICY_PASSWORDSETTINGS', 
                                'name'  => 'bJxPasswordPolicyNumbers',  
                                'type'  => 'bool', 
                                'value' => true
                                ),
                            array(
                                'group' => 'JXPASSWORDPOLICY_PASSWORDSETTINGS', 
                                'name'  => 'bJxPasswordPolicySpecialChars',  
                                'type'  => 'bool', 
                                'value' => false
                                ),
                            array(
                                'group' => 'JXPASSWORDPOLICY_PASSWORDSETTINGS', 
                                'name'  => 'sJxPasswordPolicyMinNumCharRules',  
                                'type'  => 'select', 
                                'value' => '3',
                                'constraints' => '1|2|3|4'
                                ),
                            array(
                                'group' => 'JXPASSWORDPOLICY_PASSWORDSETTINGS', 
                                'name'  => 'bJxPasswordPolicyMustntContainEmail',  
                                'type'  => 'bool', 
                                'value' => true
                                ),
                            array(
                                'group' => 'JXPASSWORDPOLICY_PASSWORDSETTINGS', 
                                'name'  => 'bJxPasswordPolicyMustntContainCustNo',  
                                'type'  => 'bool', 
                                'value' => true
                                ),
                            array(
                                'group' => 'JXPASSWORDPOLICY_PASSWORDSETTINGS', 
                                'name'  => 'bJxPasswordPolicyMustntContainName',  
                                'type'  => 'bool', 
                                'value' => true
                                ),
                            array(
                                'group' => 'JXPASSWORDPOLICY_PASSWORDSETTINGS', 
                                'name'  => 'bJxPasswordPolicyMustntContainAddress',  
                                'type'  => 'bool', 
                                'value' => true
                                ),
                        )
);
