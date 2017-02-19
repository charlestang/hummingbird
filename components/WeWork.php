<?php

namespace app\components;

use yii\authclient\OAuth2;
use yii\authclient\OAuthToken;

/**
 * Description of WeWork
 *
 * @author charles
 */
class WeWork extends OAuth2
{
    public $corpId;
    public $corpSecret;
    public $authUrl = 'https://open.work.weixin.qq.com/wwopen/sso/qrConnect';
    public $tokenUrl = 'https://qyapi.weixin.qq.com/cgi-bin/gettoken';
    public $apiBaseUrl = 'https://qyapi.weixin.qq.com/cgi-bin';
    public $agentId;
    private $code;

    
    /**
     * Composes user authorization URL.
     * @param array $params additional auth GET params.
     * @return string authorization URL.
     */
    public function buildAuthUrl(array $params = array())
    {
        $defaultParams = [
            'appid' => $this->corpId,
            'agentid' => $this->agentId,
            'redirect_uri' => $this->getReturnUrl(),
        ];

        if ($this->validateAuthState) {
            $authState = $this->generateAuthState();
            $this->setState('authState', $authState);
            $defaultParams['state'] = $authState;
        }

        return $this->composeUrl($this->authUrl, $defaultParams);
    }

    /**
     * Fetches access token from authorization code.
     * @param string $authCode authorization code, usually comes at $_GET['code'].
     * @param array $params additional request params.
     * @return OAuthToken access token.
     * @throws HttpException on invalid auth state in case [[enableStateValidation]] is enabled.
     */
    public function fetchAccessToken($authCode, array $params = array())
    {
        // check the state parameter
        if ($this->validateAuthState) {
            $authState = $this->getState('authState');
            if (!isset($_REQUEST['state']) || empty($authState) || strcmp($_REQUEST['state'], $authState) !== 0) {
                throw new HttpException(400, 'Invalid auth state parameter.');
            } else {
                $this->removeState('authState');
            }
        }

        $this->code = $authCode;

        // todo: try to restore the access_token
        //       WeWork is stupid!! this access_token should be share in corporation
        //       but, in this place it will be saved in session data

        $defaultParams = [
            'corpid' => $this->corpId,
            'corpsecret' => $this->corpSecret,
        ];

        $request = $this->createRequest()
            ->setMethod('GET')
            ->setUrl($this->tokenUrl)
            ->setData($defaultParams);

        $response = $this->sendRequest($request);

        $token = $this->createToken(['params' => $response]);
        $this->setAccessToken($token);

        return $token;
    }

    protected function initUserAttributes()
    {
        $ret = $this->api('/user/getuserinfo');
        $userId = $ret['UserId'];

        $token = $this->getAccessToken();
        $defaultParams = [
            'access_token' => $token->getToken(),
            'userid' => $userId,
        ];
        $request = $this->createRequest()
            ->setMethod('GET')
            ->setUrl('/user/get')
            ->setData($defaultParams);
        return $this->sendRequest($request);
    }

    /**
     * @inheritdoc
     */
    public function applyAccessTokenToRequest($request, $accessToken)
    {
        $data = $request->getData();
        $data['access_token'] = $accessToken->getToken();
        $data['code'] = $this->code;
        $request->setData($data);
    }

    public function refreshAccessToken(OAuthToken $token)
    {
    }
}
