<?php

/*
 *    This file is part of the module jxPassword for OXID eShop Community Edition.
 *
 *    The module jxPassword for OXID eShop Community Edition is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    The module jxPassword for OXID eShop Community Edition is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with OXID eShop Community Edition.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      https://github.com/job963/jxPassword
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @copyright (C) Joachim Barthel 2017
 *
 */

class jxpassword_oxinputvalidator extends jxpassword_oxinputvalidator_parent
{
    
    /**
     * Checking if user password is fine. In case of error
     * exception is thrown
     *
     * @param oxUser $oUser         active user
     * @param string $sNewPass      new user password
     * @param string $sConfPass     retyped user password
     * @param bool   $blCheckLength option to check password length
     * @param string $sLogin        email of the user
     * @param array  $aInvAddress   array of user profile data
     *
     * @return oxException|null
     */
    public function checkPassword($oUser, $sNewPass, $sConfPass, $blCheckLength = false, $sLogin = false, $aInvAddress = array())
    {
        $oConfig = oxRegistry::get('oxConfig');
        
    $sLogPath = $oConfig->getConfigParam("sShopDir") . '/log/';
    $fh = fopen($sLogPath.'jxmods.log', "a+");
    fputs($fh, 'checkPassword: '.$sNewPass."\n");
    fputs($fh, print_r($aInvAddress,true)."\n");
    //fputs($fh,'numCR:'.print_r($oUser,true)."\n");
    fclose($fh);
    
        $oxException = parent::checkPassword($oUser, $sNewPass, $sConfPass, $blCheckLength);
        if ($oxException) {
            return $oxException;
        }
        
        $iMinLength = $oConfig->getConfigParam('sJxPasswordMinLength');
        if ($blCheckLength && getStr()->strlen($sNewPass) < $iMinLength) {
            $oEx = oxNew('oxInputException');
            $oEx->setMessage(oxRegistry::getLang()->translateString('ERROR_MESSAGE_PASSWORD_TOO_SHORT'));

            return $this->_addValidationError("oxuser__oxpassword", $oEx);
        }
        
        $iScore = 0;
        if ($oConfig->getConfigParam('bJxPasswordUpperCase')) {
            if (preg_match('/[A-Z]/', $sNewPass)) {
                $iScore++;
            }
        }
        
        if ($oConfig->getConfigParam('bJxPasswordLowerCase')) {
            if (preg_match('/[a-z]/', $sNewPass)) {
                $iScore++;
            }
        }
        
        if ($oConfig->getConfigParam('bJxPasswordNumbers')) {
            if (preg_match('/[0-9]/', $sNewPass)) {
                $iScore++;
            }
        }
        
        if ($oConfig->getConfigParam('bJxPasswordSpecialChars')) {
            if (preg_match('/[[^a-zA-z0-9]/', $sNewPass)) {
                $iScore++;
            }
        }
        
        if ($iScore < $oConfig->getConfigParam('sJxPasswordMinNumCharRules')) {
            $oEx = oxNew('oxInputException');
            $oEx->setMessage(oxRegistry::getLang()->translateString('JXPASSWORDPOLICY_ERROR_TO_LOW_SCORE'));

            return $this->_addValidationError("oxuser__oxpassword", $oEx);
        }
        
        // User exists already
        if (!empty($oUser->oxuser__oxid)) {
echo 'oUser not empty'.'<br>';
            if ($oConfig->getConfigParam('bJxPasswordMustntContainEmail')) {
                $aEmailParts = $this->_splitEmailAddress($oUser->oxuser__oxusername->rawValue);
                
                foreach ($aEmailParts as $key => $sEmailPart) {
                    if (strpos(strtoupper($sNewPass), strtoupper($sEmailPart)) !== false) {
                        $oEx = oxNew('oxInputException');
                        $oEx->setMessage(oxRegistry::getLang()->translateString('JXPASSWORDPOLICY_ERROR_CONTAINS_EMAIL'));

                        return $this->_addValidationError("oxuser__oxpassword", $oEx);
                    }
                }
            }
            
            if ($oConfig->getConfigParam('bJxPasswordMustntContainCustNo')) {
                if (strpos($sNewPass, $oUser->oxuser__oxcustnr->rawValue) !== false) {
                        $oEx = oxNew('oxInputException');
                        $oEx->setMessage(oxRegistry::getLang()->translateString('JXPASSWORDPOLICY_ERROR_CONTAINS_CUSTNO'));

                        return $this->_addValidationError("oxuser__oxpassword", $oEx);
                }
            }
            
            if ($oConfig->getConfigParam('bJxPasswordMustntContainName')) {
                if ((strpos(strtoupper($sNewPass), strtoupper($oUser->oxuser__oxfname->rawValue)) !== false) || (strpos(strtoupper($sNewPass), strtoupper($oUser->oxuser__oxlname->rawValue)) !== false)) {
                        $oEx = oxNew('oxInputException');
                        $oEx->setMessage(oxRegistry::getLang()->translateString('JXPASSWORDPOLICY_ERROR_CONTAINS_NAME'));

                        return $this->_addValidationError("oxuser__oxpassword", $oEx);
                }
            }
        } 
        // New user
        else {
            echo 'NEUER USER:'.$sLogin.'<br>';
            if ($oConfig->getConfigParam('bJxPasswordMustntContainEmail')) {
                $aEmailParts = $this->_splitEmailAddress($sLogin);
                
                foreach ($aEmailParts as $key => $sEmailPart) {
                    if (strpos(strtoupper($sNewPass), strtoupper($sEmailPart)) !== false) {
                        $oEx = oxNew('oxInputException');
                        $oEx->setMessage(oxRegistry::getLang()->translateString('JXPASSWORDPOLICY_ERROR_CONTAINS_EMAIL'));

                        return $this->_addValidationError("oxuser__oxpassword", $oEx);
                    }
                }
            }
            
            if ($oConfig->getConfigParam('bJxPasswordMustntContainName')) {
                if ((strpos(strtoupper($sNewPass), strtoupper($aInvAddress['oxuser__oxfname'])) !== false) || (strpos(strtoupper($sNewPass), strtoupper($aInvAddress['oxuser__oxlname'])) !== false)) {
                        $oEx = oxNew('oxInputException');
                        $oEx->setMessage(oxRegistry::getLang()->translateString('JXPASSWORDPOLICY_ERROR_CONTAINS_NAME'));

                        return $this->_addValidationError("oxuser__oxpassword", $oEx);
                }
            }
        }
        
        return $oxException;
    }
    
    
    /**
     * Splits the email into the parts before @, sub and top domain
     * 
     * @param string $sEmail    Email of user
     * 
     * @return array EmailParts
     */
    private function _splitEmailAddress($sEmail)
    {
        preg_match_all("/(.*)@(.*)\.(.*)/", $sEmail, $aResult, PREG_SET_ORDER);
        
        //move one level higher
        $aResult = $aResult[0];
        
        //remove element [0]
        array_shift($aResult);
        
$oConfig = oxRegistry::get('oxConfig');
$sLogPath = $oConfig->getConfigParam("sShopDir") . '/log/';
$fh = fopen($sLogPath.'jxmods.log', "a+");
fputs($fh, print_r($aResult, true)."\n");
fclose($fh);

        return $aResult;
    }
    
}
