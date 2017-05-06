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
    'title'        => 'jxPasswordPolicy - Configurable Rules for the Password Policy',
    'description'  => array(
                        'de' => '<b>Ermitteln der Lagerstandsdaten von den Lieferanten Websites oder Webshops</b><ul>'
                                . '<li>Aufrufen der Lieferantenseiten'
                                . '<li>Analysieren der Lagerbestandsdaten'
                                . '<li>Aktualisieren der Shop-Artikel</ul>',
                        'en' => '<b>Collecting of stock data from deliverer websites or webshops</b><ul>'
                                . '<li>Retrieving the deliverer product pages'
                                . '<li>Analyzing the stock data'
                                . '<li>Updating the shop products</ul>',
                        ),
    'thumbnail'    => 'jxpasswordpolicy.png',
    'version'      => '0.1.0',
    'author'       => 'Joachim Barthel',
    'url'          => 'https://github.com/job963/jxPasswordPolicy',
    'email'        => 'jobarthel@gmail.com',
    'extend'       => array(
                            'oxinputvalidator'    =>      'jxmods/jxPasswordPolicy/core/jxpasswordpolicy_oxinputvalidator' 
                        ),
    'files'        => array(
                            'jxpasswordpolicy_oxInputValidator' => 'jxmods/jxPasswordPolicy/core/jxpasswordpolicy_oxinputvalidator.php',
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
                        )
);
