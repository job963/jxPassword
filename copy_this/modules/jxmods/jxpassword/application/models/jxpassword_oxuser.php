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

class jxpassword_oxuser extends jxpassword_oxuser_parent
{
    
    /**
     * Performs bunch of checks if user profile data is correct; on any
     * error exception is thrown
     *
     * @param string $sLogin      user login name
     * @param string $sPassword   user password
     * @param string $sPassword2  user password to compare
     * @param array  $aInvAddress array of user profile data
     * @param array  $aDelAddress array of user profile data
     *
     * @todo currently this method calls oxUser class methods responsible for
     * input validation. In next major release these should be replaced by direct
     * oxInputValidation calls
     *
     * @throws oxUserException, oxInputException
     */
    public function checkValues($sLogin, $sPassword, $sPassword2, $aInvAddress, $aDelAddress)
    {
        /** @var oxInputValidator $oInputValidator */
        $oInputValidator = oxRegistry::get('oxInputValidator');

        // 1. checking user name
        $sLogin = $oInputValidator->checkLogin($this, $sLogin, $aInvAddress);

        // 2. checking email
        $oInputValidator->checkEmail($this, $sLogin, $aInvAddress);

        // 3. password
echo 'new checkValues: sLogin='.$sLogin.'<br>';        
        $oInputValidator->checkPassword($this, $sPassword, $sPassword2, ((int) oxRegistry::getConfig()->getRequestParameter('option') == 3), $sLogin, $aInvAddress);

        // 4. required fields
        $oInputValidator->checkRequiredFields($this, $aInvAddress, $aDelAddress);

        // 5. country check
        $oInputValidator->checkCountries($this, $aInvAddress, $aDelAddress);

        // 6. vat id check.
        $oInputValidator->checkVatId($this, $aInvAddress);


        // throwing first validation error
        if ($oError = oxRegistry::get("oxInputValidator")->getFirstValidationError()) {
            throw $oError;
        }
    }
  
}