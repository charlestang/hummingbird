<?php

namespace app\components;

/**
 * Thisi is the auth client of Coding.net
 *
 * @author charles <charlestang@foxmail.com>
 */
class Coding extends \yii\authclient\OAuth2
{

    /**
     * @inheritdoc
     */
    public $authUrl = 'https://coding.net/oauth_authorize.html';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://coding.net/api/oauth/access_token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://coding.net/api';

    /**
     * @inheritdoc
     */
    public $scope = 'user';

    //put your code here
    protected function initUserAttributes()
    {
        $response               = $this->api('/account/current_user');
        $data                   = $response['data'];
        $attributes             = [];
        $attributes['username'] = $data['global_key'];
        $attributes['nickname'] = $data['name'];
        return $attributes;
    }
}
