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

class jxpassword_account_password extends jxpassword_account_password_parent
{

    /**
     * changes current user password
     *
     * @return null
     */
    public function changePassword()
    {
        if (!oxRegistry::getSession()->checkSessionChallenge()) {
            return;
        }

        $oUser = $this->getUser();
        if (!$oUser) {
            return;
        }

        $sOldPass = oxRegistry::getConfig()->getRequestParameter('password_old', true);
        $sNewPass = oxRegistry::getConfig()->getRequestParameter('password_new', true);
        $sConfPass = oxRegistry::getConfig()->getRequestParameter('password_new_confirm', true);

        /** @var oxInputValidator $oInputValidator */
        $oInputValidator = oxRegistry::get('oxInputValidator');
        if (($oExcp = $oInputValidator->checkPassword($oUser, $sNewPass, $sConfPass, true, $sOldPass))) {
            $sErrMsg = $oExcp->getMessage();
            if (sErrMsg == 'ERROR_MESSAGE_INPUT_EMPTYPASS') {
                $sErrMsg = 'ERROR_MESSAGE_PASSWORD_TOO_SHORT';
            }
            return oxRegistry::get("oxUtilsView")->addErrorToDisplay(
                $sErrMsg,
                false,
                true
            );
        }

        if (!$sOldPass || !$oUser->isSamePassword($sOldPass)) {
            /** @var oxUtilsView $oUtilsView */
            $oUtilsView = oxRegistry::get("oxUtilsView");

            return $oUtilsView->addErrorToDisplay('ERROR_MESSAGE_CURRENT_PASSWORD_INVALID', false, true);
        }

        // testing passed - changing password
        $oUser->setPassword($sNewPass);
        if ($oUser->save()) {
            $this->_blPasswordChanged = true;
            // deleting user autologin cookies.
            oxRegistry::get("oxUtilsServer")->deleteUserCookie($this->getConfig()->getShopId());
        }
    }

}
