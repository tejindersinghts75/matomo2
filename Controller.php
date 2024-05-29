<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\LoginTokenAuth;

use Exception;
use Piwik\Common;
use Piwik\Piwik;
use Piwik\Plugins\UsersManager\Model AS UsersModel;

class Controller extends \Piwik\Plugins\Login\Controller
{
    /**
     * token_auth login
     *
     * @throws \Exception
     * @return void
     */
    function logme()
    {
        $tokenAuth = Common::getRequestVar('token_auth', null, 'string');

        $model = new UsersModel();
        $user = $model->getUserByTokenAuth($tokenAuth);
        if (!$user) {
            throw new Exception(Piwik::translate('Login_InvalidOrExpiredToken'));
        }

        if (Piwik::hasTheUserSuperUserAccess($user['login'])) {
            throw new Exception(Piwik::translate('Login_ExceptionInvalidSuperUserAccessAuthenticationMethod', array("logme")));
        }

        $this->auth->setTokenAuth($tokenAuth);

        $currentUrl = 'index.php';
        if ($this->idSite) {
            $currentUrl .= '?idSite=' . $this->idSite;
        }

        $urlToRedirect = Common::getRequestVar('url', $currentUrl, 'string');
        $urlToRedirect = Common::unsanitizeInputValue($urlToRedirect);

        $this->authenticateAndRedirect(null, null, $urlToRedirect, $passwordHashed = true);
    }
}
