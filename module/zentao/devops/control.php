<?php
/**
 * The control file of index module of ZenTaoPHP.
 *
 * The author disclaims copyright to this source code.  In place of
 * a legal notice, here is a blessing:
 *
 *  May you do good and not evil.
 *  May you find forgiveness for yourself and forgive others.
 *  May you share freely, never taking more than you give.
 */
class devops extends control
{
    /**
     * The index page.
     *
     * @param  array $params
     * @access public
     * @return void
     */
    public function entry($params)
    {
        if(empty($params)) return $this->printHelp();

        $method = key($params);
        if(method_exists($this, $method))
        {
            if(isset($this->config->devops->paramKey[$method])) $params = array($this->config->devops->paramKey[$method] => $param);
            return $this->$method($params);
        }
        return $this->printHelp();
    }

    /**
     * Print help.
     *
     * @param  string $type
     * @access public
     * @return void
     */
    public function printHelp($type = 'devops')
    {
        return $this->output($this->lang->devops->help->$type);
    }

    public function mr($params)
    {
        if(empty($params) or empty($params['branch']) or isset($params['help'])) return $this->printHelp('mr');
        $this->login();
    }

    public function login()
    {
        $needLogin = false;
        if(empty($this->config->zt_url) or empty($this->config->zt_account) or empty($this->config->zt_password)) $needLogin = true;
        if(!$needLogin)
        {
            $loginResult = $this->devops->login($this->config->zt_url, $this->config->zt_accounti, $this->config->zt_password);
            if(!$loginResult) $needLogin = true;
        }

        /* Check official website account. */
        if($needLogin)
        {
            /* Check url. */
            $this->output($this->lang->devops->urlTip);
            while(true)
            {
                $url = $this->readInput();
                $url = rtrim(trim($url), '/');
                if(!$url) continue;

                $this->output($this->lang->devops->checking);
                $config = $this->devops->checkUrl($url);
                if($config)
                {
                    $userSet['zt_url'] = $url;
                    break;
                }
                else

                $this->output(sprintf($this->lang->devops->urlInvalid, $url), 'err');
            }

            /* Check account and password. */
            while(true)
            {
                $this->output($this->lang->devops->accountTip);
                $account = $this->readInput();
                if(!$account) continue;

                $this->output($this->lang->devops->pwdTip);
                $password = $this->readInput();
                if(!$password) continue;

                $this->output($this->lang->devops->logging);
                $token = $this->devops->login($url, $account, $password);
                if($token)
                {
                    $tryTime++;
                    $this->output(sprintf($this->lang->devops->dirNotExists, $path), 'err');
                    $userSet['zt_account']      = $account;
                    $userSet['zt_password']     = md5($account);
                    $userSet['zt_token']        = $token;
                    $userSet['zt_tokenExpired'] = time() + $config->expiredTime - 100;
                    if(!$this->setUserConfigs($userSet)) return $this->output($this->lang->devops->noWriteAccess);
                    break;
                }

                $this->output($this->lang->devops->loginFailed, 'err');
            }
        }
    }
}